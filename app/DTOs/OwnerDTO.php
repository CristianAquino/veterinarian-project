<?php

namespace App\DTOs;

class OwnerDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $surname,
        public readonly ?string $phone,
        public readonly ?string $email,
        public readonly string $dni,
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->surname,
            $model->phone,
            $model->email,
            $model->dni
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

    public static function fromModelWithRelation($model): array
    {
        $pets = PetDTO::fromModelCollection($model->pets);

        return [
            'id' => $model->id,
            'name' => $model->name,
            'surname' => $model->surname,
            'phone' => $model->phone,
            'email' => $model->email,
            'dni' => $model->dni,
            'pets' => $pets
        ];
    }
}
