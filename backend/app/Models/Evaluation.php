<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'admin_id',
        'score',
        'description',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
