<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\BrandData;
use App\Models\Brand;

class BrandRepository
{
    /**
     * @return array
     */
    public function all(): array
    {
        return Brand::all()->map(fn($brand) => BrandData::fromModel($brand))->toArray();
    }
}
