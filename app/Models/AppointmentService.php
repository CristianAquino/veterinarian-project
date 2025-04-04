<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentService extends Model
{
    //
    protected $table = 'appointment_service';
    // relations
    public function billItems(): HasMany
    {
        return $this->hasMany(BillItem::class);
    }
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
