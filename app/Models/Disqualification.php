<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disqualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'stage',
        'reason',
        'notice_issued_at',
        'requirements_returned',
    ];

    public function applicant() { return $this->belongsTo(Applicant::class); }
    public function appeals() { return $this->hasMany(Appeal::class); }
}