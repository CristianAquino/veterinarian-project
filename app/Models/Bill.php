<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    //
    // uuid
    use HasUuids;

    protected $filable = [
        'total_amount',
        'owner_id'
    ];

    // redondeo de total_amount a dos decimales
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_amount = round($model->total_amount, 2);
        });
    }

    // relations
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}