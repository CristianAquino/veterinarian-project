<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalRecord extends Model
{
    //
    // uuid
    use HasUuids;

    protected $fillable = [
        'diagnosis',
        'treatment',
        'pet_id',
        'employee_id',
    ];

    // relations
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
}
