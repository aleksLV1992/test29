<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\CarModelData;
use App\Models\CarModel;

class CarModelRepository
{
    /**
     * @return array
     */
    public function all(): array
    {
        return CarModel::with('brand')->get()
            ->map(fn($model) => CarModelData::fromModel($model))
            ->toArray();
    }
}
