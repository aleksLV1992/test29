<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\CarData;
use App\Models\Car;

class CarRepository
{
    /**
     * @param int $userId
     * @return array
     */
    public function allByUser(int $userId): array
    {
        return Car::with('brand', 'carModel', 'user')
            ->where('user_id', $userId)
            ->get()
            ->map(fn($car) => CarData::fromModel($car))
            ->toArray();
    }

    /**
     * @param int $id
     * @param int $userId
     * @return CarData|null
     */
    public function findByIdAndUser(int $id, int $userId): ?CarData
    {
        $car = Car::with('brand', 'carModel', 'user')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        return $car ? CarData::fromModel($car) : null;
    }

    /**
     * @param int $id
     * @return CarData|null
     */
    public function findById(int $id): ?CarData
    {
        $car = Car::with('brand', 'carModel', 'user')->find($id);
        return $car ? CarData::fromModel($car) : null;
    }

    /**
     * @param array $data
     * @return CarData
     */
    public function create(array $data): CarData
    {
        $car = Car::create($data);
        return CarData::fromModel($car->load('brand', 'carModel', 'user'));
    }

    /**
     * @param int $id
     * @param array $data
     * @return CarData
     */
    public function update(int $id, array $data): CarData
    {
        $car = Car::find($id);
        if (!$car) {
            abort(404, 'Автомобиль не найден');
        }

        $car->update($data);
        return CarData::fromModel($car->fresh('brand', 'carModel', 'user'));
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $car = Car::find($id);
        if (!$car) {
            abort(404, 'Автомобиль не найден');
        }

        $car->delete();
    }
}
