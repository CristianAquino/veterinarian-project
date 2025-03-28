<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    //
    protected $filable = [
        'message',
        'type',
        'inventory_id'
    ];

    public const STATUS = [
        'info',
        'warning',
        'danger'
    ];
    // relations
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}