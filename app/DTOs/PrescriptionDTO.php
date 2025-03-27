<?php

namespace App\DTOs;

class PrescriptionDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly int $id,
        public readonly ?string $medication_name,
        public readonly string $dosage,
        public readonly ?string $notes,
        public readonly string $employee_id,
        public readonly string $medical_record_id,
        public readonly ?string $medication_id
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->medication_name,
            $model->dosage,
            $model->notes,
            $model->user_id,
            $model->medical_record_id,
            $model->medication_id,
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