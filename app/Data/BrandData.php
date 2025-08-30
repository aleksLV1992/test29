<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Brand;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class BrandData extends Data
{
    /**
     * @param int $id
     * @param string $name
     * @param string $createdAt
     * @param string $updatedAt
     */
    public function __construct(
        public int $id,
        public string $name,
        #[MapName('created_at')]
        public string $createdAt,
        #[MapName('updated_at')]
        public string $updatedAt,
    ) {}

    /**
     * @param Brand $brand
     * @return self
     */
    public static function fromModel(Brand $brand): self
    {
        return new self(
            id: $brand->id,
            name: $brand->name,
            createdAt: $brand->created_at->toISOString(),
            updatedAt: $brand->updated_at->toISOString()
        );
    }
}
