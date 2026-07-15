<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCompliance extends Model
{
    use HasFactory;

    protected $table = 'waste_compliances';

    protected $fillable = [
        'applicant_id',
        'semester',
        'kilos_required',
        'kilos_submitted',
        'is_compliant',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}