<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewerScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'interviewer_question_id',
        'interview_applicant_id',
        'interview_id',
        'score',
    ];

    public function interviewerQuestion()
    {
        return $this->belongsTo(InterviewerQuestion::class);
    }

    public function interviewApplicant()
    {
        return $this->belongsTo(InterviewApplicant::class);
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
}