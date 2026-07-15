<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'in_spes',
        'in_4ps',
        'one_scholar_per_family_ok',
        'is_disqualified',
        'remarks',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}