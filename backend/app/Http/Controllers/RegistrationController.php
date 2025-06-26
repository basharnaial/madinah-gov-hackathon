<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterParticipantRequest;
use App\Models\Participant;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    /**
     * Register a new participant
     */
    public function register(RegisterParticipantRequest $request): JsonResponse
    {
        try {
            // Handle file upload
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
            }

            // Create participant
            $participant = Participant::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'age' => $request->age,
                'city' => $request->city,
                'field_of_interest' => $request->field_of_interest,
                'registration_type' => $request->registration_type,
                'cv_path' => $cvPath,
                'project_idea' => $request->project_idea,
                'status' => 'Pending',
                'terms_accepted' => true,
            ]);

            // Handle team members if registration type is Team
            if ($request->registration_type === 'Team' && $request->has('team_members') && is_array($request->team_members)) {
                foreach ($request->team_members as $memberName) {
                    if (!empty(trim($memberName))) {
                        TeamMember::create([
                            'participant_id' => $participant->id,
                            'name' => trim($memberName),
                        ]);
                    }
                }
            }

            // Send confirmation email
            $this->sendConfirmationEmail($participant);

            return response()->json([
                'success' => true,
                'message' => 'تم التسجيل بنجاح! سيتم إرسال تأكيد عبر البريد الإلكتروني.',
                'data' => [
                    'id' => $participant->id,
                    'full_name' => $participant->full_name,
                    'email' => $participant->email,
                ]
            ], 201);

        } catch (\Exception $e) {
            // Delete uploaded file if participant creation fails
            if (isset($cvPath) && Storage::disk('public')->exists($cvPath)) {
                Storage::disk('public')->delete($cvPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send confirmation email to participant
     */
    private function sendConfirmationEmail(Participant $participant): void
    {
        try {
            Mail::send('emails.registration-confirmation', [
                'participant' => $participant
            ], function ($message) use ($participant) {
                $message->to($participant->email, $participant->full_name)
                        ->subject('تأكيد التسجيل - برمجان المدينة');
            });
        } catch (\Exception $e) {
            // Log email error but don't fail the registration
            \Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }
    }

    /**
     * Get field of interest options
     */
    public function getFieldOfInterestOptions(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Participant::$fieldOfInterestOptions
        ]);
    }

    /**
     * Get registration type options
     */
    public function getRegistrationTypeOptions(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Participant::$registrationTypeOptions
        ]);
    }
}
