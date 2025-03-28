<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medication extends Model
{
    //
    protected $filable = [
        'name',
        'description',
        'type'
    ];

    public const TYPE = [
        'pill',
        'injection',
        'syrup',
        'cream',
        'other'
    ];
    // relations
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }
}
