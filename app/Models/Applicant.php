<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'school_id',
        'grade_average',
        'program_type',
        'status',
        'family_household_id',
    ];

    public function requirements() { return $this->hasMany(ApplicantRequirement::class); }
    public function verification() { return $this->hasOne(ProgramVerification::class); }
    public function mswdoAssessment() { return $this->hasOne(MswdoAssessment::class); }
    public function examResults() { return $this->hasMany(ExamResult::class); }
    public function orientation() { return $this->hasOne(Orientation::class); }
    public function wasteCompliance() { return $this->hasMany(WasteCompliance::class); }
    public function payouts() { return $this->hasMany(Payout::class); }
    public function disqualifications() { return $this->hasMany(Disqualification::class); }
}