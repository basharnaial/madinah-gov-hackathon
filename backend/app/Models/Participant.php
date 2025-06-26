<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'age',
        'city',
        'field_of_interest',
        'registration_type',
        'cv_path',
        'project_idea',
        'status',
        'terms_accepted',
    ];

    protected $casts = [
        'age' => 'integer',
        'terms_accepted' => 'boolean',
    ];

    // Validation rules
    public static $rules = [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:participants,email',
        'phone' => 'required|string|max:20',
        'age' => 'required|integer|min:16|max:100',
        'city' => 'required|string|max:255',
        'field_of_interest' => 'required|in:AI,Web Development,IoT,Mobile Development,Data Science,Cybersecurity,Blockchain,Other',
        'registration_type' => 'required|in:Individual,Team,Organization',
        'cv_path' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
        'project_idea' => 'nullable|string|max:1000',
        'terms_accepted' => 'required|accepted',
    ];

    // Field of interest options
    public static $fieldOfInterestOptions = [
        'AI' => 'Artificial Intelligence',
        'Web Development' => 'Web Development',
        'IoT' => 'Internet of Things',
        'Mobile Development' => 'Mobile Development',
        'Data Science' => 'Data Science',
        'Cybersecurity' => 'Cybersecurity',
        'Blockchain' => 'Blockchain',
        'Other' => 'Other',
    ];

    // Registration type options
    public static $registrationTypeOptions = [
        'Individual' => 'Individual',
        'Team' => 'Team',
        'Organization' => 'Organization',
    ];

    // Status options
    public static $statusOptions = [
        'Pending' => 'Pending',
        'Approved' => 'Approved',
        'Rejected' => 'Rejected',
    ];

    // Get CV URL
    public function getCvUrlAttribute()
    {
        return $this->cv_path ? asset('storage/' . $this->cv_path) : null;
    }

    // Team members relationship
    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class);
    }

    // Evaluation relationship
    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}
