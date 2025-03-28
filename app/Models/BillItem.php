<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillItem extends Model
{
    //

    protected $fillable = [
        'quantity',
        'price',
        'subtotal',
        'bill_id',
        'appointment_service_id',
        'inventory_id',
    ];

    // redondeo de price ab subtotal a dos decimales
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->price = round($model->price, 2);
            $model->subtotal = round($model->subtotal, 2);
        });
    }

    // relations
    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
    public function appointmentService(): BelongsTo
    {
        return $this->belongsTo(AppointmentService::class);
    }
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}