<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_id',
        'applicant_id',
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function scores()
    {
        return $this->hasMany(InterviewerScore::class);
    }
}