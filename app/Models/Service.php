<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'description',
    ];
    // redondeo de price a dos decimales
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->price = round($model->price, 2);
        });
    }

    // relations
    public function appointments(): BelongsToMany
    {
        return $this->belongsToMany(Appointment::class)
            ->withTimestamps()
            ->withPivot('id');
    }
}
