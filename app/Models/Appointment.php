<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    //

    protected $filable = [
        'date',
        'start_time',
        'reason',
        'is_emergency',
        'status',
        'owner_id',
        'employee_id'
    ];

    public const STATUS = [
        'pending',
        'in_progress',
        'completed',
        'cancelled',
    ];

    // relations
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps()
            ->withPivot('id');
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
