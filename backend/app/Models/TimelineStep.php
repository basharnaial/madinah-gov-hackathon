<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'subtitle_ar',
        'subtitle_en',
        'description_ar',
        'description_en',
        'step_date',
        'due_date',
        'order',
        'is_active'
    ];

    protected $casts = [
        'step_date' => 'date',
        'due_date' => 'date',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    // Default ordering by order field
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('order');
        });
    }

    // Scope for active steps only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
