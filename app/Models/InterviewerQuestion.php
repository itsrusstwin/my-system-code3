<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewerQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'interview_id',
        'question_id',
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function scores()
    {
        return $this->hasMany(InterviewerScore::class);
    }
}