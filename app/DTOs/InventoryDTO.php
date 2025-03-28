<?php

namespace App\DTOs;

class InventoryDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly int $id,
        public readonly string $batch_number,
        public readonly int $quantity,
        public readonly string $expiry_date,
        public readonly bool $expired,
        public readonly float $unit_price,
        public readonly int $medication_id,
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->batch_number,
            $model->quantity,
            $model->expiry_date,
            $model->expired,
            $model->unit_price,
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