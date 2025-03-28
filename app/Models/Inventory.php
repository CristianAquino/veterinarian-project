<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    //
    protected $fillable = [
        'batch_number',
        'quantity',
        'expiration_date',
        'expired',
        'unit_price',
        'medication_id'
    ];
    // redondeo de unit_price a dos decimales
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->unit_price = round($model->unit_price, 2);
        });
    }

    // relations
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }
    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }
}