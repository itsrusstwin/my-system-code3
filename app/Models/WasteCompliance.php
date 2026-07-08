<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCompliance extends Model
{
    use HasFactory;

    protected $table = 'waste_compliances'; // explicit, since default would look for "waste_compliances" anyway, but good to be clear

    protected $fillable = [
        'applicant_id',
        'semester',
        'kilos_required',
        'kilos_submitted',
        'is_compliant',
    ];

    public function applicant() { return $this->belongsTo(Applicant::class); }
}