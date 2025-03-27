<?php

namespace App\DTOs;

class MedicalRecordDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $pet_id,
        public readonly string $employee_id,
        public readonly string $diagnosis,
        public readonly ?string $treatment,
        public readonly string $date
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->pet_id,
            $model->user_id,
            $model->diagnosis,
            $model->treatment,
            $model->created_at->format('d/m/Y')
        );
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
            return self::fromBaseModel($collection);
        }, $collections);
    }
}
