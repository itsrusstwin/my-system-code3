<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'gender',
        'birthdate',
        'civil_status',
        'address',
        'position_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // Interviews this applicant is part of
    public function interviews()
    {
        return $this->belongsToMany(Interview::class, 'interview_applicants')
            ->withTimestamps();
    }

    // Direct access to the pivot records (needed for scoring)
    public function interviewApplicants()
    {
        return $this->hasMany(InterviewApplicant::class);
    }
}