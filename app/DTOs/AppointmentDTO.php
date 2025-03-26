<?php

namespace App\DTOs;

class AppointmentDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $date,
        public readonly string $start_time,
        public readonly ?string $reason,
        public readonly bool $is_emergency,
        public readonly string $status,
    ) {
        //
    }

    public static function fromPagination($model): array
    {
        return [
            'data' => self::fromPaginationCollection($model->items()),
            'pagination' => PaginationDTO::base($model)
        ];
    }

    public static function fromPaginationCollection($collections): array
    {
        return array_map(function ($collection) {
            return self::fromModelWithRelation($collection);
        }, $collections);
    }

    public static function fromModelWithRelation($model): array
    {
        $employee = EmployeeDTO::fromBaseModel($model->user);
        $owner = OwnerDTO::fromBaseModel($model->owner);

        return [
            'id' => $model->id,
            'date' => $model->date,
            'start_time' => $model->start_time,
            'reason' => $model->reason,
            'is_emergency' => $model->is_emergency,
            'status' => $model->status,
            'employee' => $employee,
            'owner' => $owner
        ];
    }
}
