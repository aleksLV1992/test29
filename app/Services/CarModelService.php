<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CarModelRepository;

class CarModelService
{
    /**
     * @param CarModelRepository $repository
     */
    public function __construct(
        protected CarModelRepository $repository,
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
