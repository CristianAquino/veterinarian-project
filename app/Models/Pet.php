<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    //
    protected $fillable = [
        'name',
        'species',
        'bred',
        'age',
        'weight',
        'gender',
        'owner_id',
    ];

    public const SPECIES = [
        'Dog',
        'Cat',
    ];
    public const GENDER = [
        'Male',
        'Female',
    ];

    // relations
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    // redondeo de weight a dos decimales
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->weight = round($model->weight, 2);
        });
    }
}
