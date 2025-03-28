<?php

namespace App\DTOs;

class BillItemDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly int $id,
        public readonly int $quantity,
        public readonly float $price,
        public readonly float $subtotal,
        public readonly string $bill_id,
        public readonly ?int $appointment_service_id,
        public readonly ?int $inventory_id
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->quantity,
            $model->price,
            $model->subtotal,
            $model->bill_id,
            $model->appointment_service_id,
            $model->inventory_id,
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