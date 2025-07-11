<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Evaluation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;

class ParticipantController extends Controller
{
    /**
     * Get participants list with filters
     */
    public function index(Request $request): JsonResponse
    {
        $query = Participant::with(['teamMembers', 'evaluation']);

        // Apply filters
        if ($request->filled('registration_type')) {
            $query->where('registration_type', $request->registration_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('field_of_interest')) {
            $query->where('field_of_interest', $request->field_of_interest);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $participants = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $participants,
            'filters' => [
                'registration_type_options' => Participant::$registrationTypeOptions,
                'status_options' => Participant::$statusOptions,
                'field_of_interest_options' => Participant::$fieldOfInterestOptions,
            ]
        ]);
    }

    /**
     * Get participant details
     */
    public function show(Participant $participant): JsonResponse
    {
        $participant->load(['teamMembers', 'evaluation']);
        
        return response()->json([
            'success' => true,
            'data' => $participant
        ]);
    }

    /**
     * Approve participant with evaluation
     */
    public function approve(Request $request, Participant $participant): JsonResponse
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'description' => 'required|string|min:10|max:1000',
        ]);

        // Create evaluation record
        $evaluation = Evaluation::create([
            'participant_id' => $participant->id,
            'admin_id' => Auth::guard('admin')->id(),
            'score' => $request->score,
            'description' => $request->description,
        ]);

        // Update participant status to approved
        $participant->update([
            'status' => 'Approved'
        ]);

        // Load the evaluation relationship
        $participant->load(['evaluation', 'teamMembers']);

        return response()->json([
            'success' => true,
            'message' => 'تم قبول المشارك وحفظ التحكيم بنجاح',
            'data' => $participant
        ]);
    }

    /**
     * Reject participant
     */
    public function reject(Request $request, Participant $participant): JsonResponse
    {
        $participant->update([
            'status' => 'Rejected'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم رفض المشارك',
            'data' => $participant
        ]);
    }

    /**
     * Download participant CV
     */
    public function downloadCv(Participant $participant)
    {
        if (!$participant->cv_path) {
            return response()->json([
                'success' => false,
                'message' => 'لا يوجد ملف سيرة ذاتية'
            ], 404);
        }

        if (!Storage::disk('public')->exists($participant->cv_path)) {
            return response()->json([
                'success' => false,
                'message' => 'الملف غير موجود'
            ], 404);
        }

        // Get file info
        $filePath = Storage::disk('public')->path($participant->cv_path);
        $originalName = basename($participant->cv_path);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        
        // Create a clean filename
        $cleanName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $participant->full_name);
        $filename = "cv-{$cleanName}.{$extension}";

        return Storage::disk('public')->download($participant->cv_path, $filename);
    }

    /**
     * Export participants to Excel
     */
    public function exportToExcel(Request $request)
    {
        $query = Participant::with(['teamMembers', 'evaluation']);

        // Apply same filters as index method
        if ($request->filled('registration_type')) {
            $query->where('registration_type', $request->registration_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('field_of_interest')) {
            $query->where('field_of_interest', $request->field_of_interest);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Order by creation date (newest first)
        $query->orderBy('created_at', 'desc');

        $participants = $query->get();

        // Generate filename with current date and filters info
        $filename = 'participants-' . date('Y-m-d');
        if ($request->filled('status')) {
            $filename .= '-' . $request->status;
        }
        if ($request->filled('registration_type')) {
            $filename .= '-' . $request->registration_type;
        }
        $filename .= '.xlsx';

        return Excel::download(new ParticipantsExport($participants), $filename);
    }

    /**
     * Get dashboard statistics
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total_participants' => Participant::count(),
            'pending_participants' => Participant::where('status', 'Pending')->count(),
            'approved_participants' => Participant::where('status', 'Approved')->count(),
            'rejected_participants' => Participant::where('status', 'Rejected')->count(),
            'individual_participants' => Participant::where('registration_type', 'Individual')->count(),
            'team_participants' => Participant::where('registration_type', 'Team')->count(),
            'field_of_interest_stats' => Participant::selectRaw('field_of_interest, COUNT(*) as count')
                ->groupBy('field_of_interest')
                ->pluck('count', 'field_of_interest')
                ->toArray(),
            'recent_registrations' => Participant::latest()->take(5)->get(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
