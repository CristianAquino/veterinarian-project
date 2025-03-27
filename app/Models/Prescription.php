<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    //
    protected $fillable = [
        'medication_name',
        'dosage',
        'notes',
        'employee_id',
        'medical_record_id',
        'medication_id'
    ];

    // relations
    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}