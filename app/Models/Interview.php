<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_date',
        'position_id',
        'status',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // Applicants scheduled for this interview
    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'interview_applicants')
            ->withTimestamps();
    }

    // Direct access to pivot records
    public function interviewApplicants()
    {
        return $this->hasMany(InterviewApplicant::class);
    }

    // Panel members assigned to this interview
    public function interviewers()
    {
        return $this->hasMany(Interviewer::class);
    }

    // Questions attached to this interview (through interviewer_questions)
    public function interviewerQuestions()
    {
        return $this->hasMany(InterviewerQuestion::class);
    }

    public function scores()
    {
        return $this->hasMany(InterviewerScore::class);
    }
}