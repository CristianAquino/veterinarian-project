<?php

namespace App\DTOs;

class PetDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $species,
        public readonly ?string $breed,
        public readonly ?int $age,
        public readonly ?float $weight,
        public readonly string $gender,
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->species,
            $model->bree,
            $model->age,
            $model->weight,
            $model->gender,
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

    public static function fromModelCollection($collections): array
    {
        return array_map(function ($collection) {
            return self::fromBaseModel($collection);
        }, $collections->all());
    }
}
