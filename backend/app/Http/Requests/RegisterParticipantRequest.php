<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can register
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:16|max:100',
            'city' => 'required|string|max:255',
            'field_of_interest' => 'required|in:AI,Web Development,IoT,Mobile Development,Data Science,Cybersecurity,Blockchain,Other',
            'registration_type' => 'required|in:Individual,Team,Organization',
            'cv' => 'required|file|mimes:pdf|max:5120', // 5MB max
            'project_idea' => 'nullable|string|max:1000',
            'terms_accepted' => 'required|accepted',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الكامل مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
            'phone.required' => 'رقم الهاتف مطلوب',
            'age.required' => 'العمر مطلوب',
            'age.min' => 'يجب أن يكون العمر 16 سنة على الأقل',
            'age.max' => 'يجب أن يكون العمر 100 سنة كحد أقصى',
            'city.required' => 'المدينة مطلوبة',
            'field_of_interest.required' => 'مجال الاهتمام مطلوب',
            'field_of_interest.in' => 'مجال الاهتمام غير صحيح',
            'registration_type.required' => 'نوع التسجيل مطلوب',
            'registration_type.in' => 'نوع التسجيل غير صحيح',
            'cv.required' => 'السيرة الذاتية مطلوبة',
            'cv.file' => 'يجب أن يكون الملف صحيحاً',
            'cv.mimes' => 'يجب أن يكون الملف بصيغة PDF',
            'cv.max' => 'حجم الملف يجب أن يكون أقل من 5 ميجابايت',
            'project_idea.max' => 'وصف المشروع يجب أن يكون أقل من 1000 حرف',
            'terms_accepted.required' => 'يجب الموافقة على الشروط والأحكام',
            'terms_accepted.accepted' => 'يجب الموافقة على الشروط والأحكام',
        ];
    }
}
