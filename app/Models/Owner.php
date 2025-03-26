<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    //
    // uuid
    use HasUuids;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'dni'
    ];

    // relations
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
