<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\CarModel;
use Spatie\LaravelData\Data;

class CarModelData extends Data
{
    /**
     * @param int $id
     * @param string $name
     * @param BrandData $brand
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        public int $id,
        public string $name,
        public BrandData $brand,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    /**
     * @param CarModel $model
     * @return self
     */
    public static function fromModel(CarModel $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            brand: BrandData::fromModel($model->brand),
            createdAt: $model->created_at->toISOString(),
            updatedAt: $model->updated_at->toISOString()
        );
    }
}
