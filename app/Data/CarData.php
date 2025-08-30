<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Car;
use Spatie\LaravelData\Data;

class CarData extends Data
{
    /**
     * @param int $id
     * @param BrandData $brand
     * @param CarModelData $carModel
     * @param int|null $year
     * @param int|null $mileage
     * @param string|null $color
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        public int              $id,
        public BrandData        $brand,
        public CarModelData     $carModel,
        public ?UserData $user,
        public string|int|null  $year,
        public string|int|null $mileage,
        public ?string          $color,
        public string           $createdAt,
        public string           $updatedAt,
    )
    {
    }

    /**
     * @param Car $car
     * @return self
     */
    public static function fromModel(Car $car): self
    {
        return new self(
            id: $car->id,
            brand: BrandData::fromModel($car->brand),
            carModel: CarModelData::fromModel($car->CarModel),
            user: $car->user ? UserData::fromModel($car->user) : null, // ← добавлено
            year: $car->year,
            mileage: $car->mileage,
            color: $car->color,
            createdAt: $car->created_at->toISOString(),
            updatedAt: $car->updated_at->toISOString()
        );
    }
}
