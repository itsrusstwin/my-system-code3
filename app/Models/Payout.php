<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'amount',
        'released_at',
        'reference_no',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}