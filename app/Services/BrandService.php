<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BrandRepository;

class BrandService
{
    /**
     * @param BrandRepository $repository
     */
    public function __construct(
        protected BrandRepository $repository,
    )
    {
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->repository->all();
    }

}
