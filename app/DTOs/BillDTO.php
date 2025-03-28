<?php

namespace App\DTOs;

class BillDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $id,
        public readonly float $total_amount,
        public readonly string $owner_id,
        public readonly string $date
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->total_amount,
            $model->owner_id,
            $model->updated_at->format('Y-m-d'),
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