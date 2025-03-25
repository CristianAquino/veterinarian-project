<?php

namespace App\DTOs;

class EmployeeDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $surname,
        public readonly string $role,
        public readonly ?string $speciality,
    ) {
        //
    }

    public static function fromBaseModel($model): self
    {
        return new self(
            $model->id,
            $model->name,
            $model->surname,
            $model->role,
            $model->speciality
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

    public static function toData($model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'surname' => $model->surname,
            'role' => $model->role,
            'speciality' => $model->speciality,
            'email' => $model->email,
            'phone' => $model->phone,
            'dni' => $model->dni,
        ];
    }
}
