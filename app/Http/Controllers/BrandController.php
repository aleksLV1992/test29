<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use Symfony\Component\HttpFoundation\JsonResponse;

class BrandController extends Controller
{

    /**
     * @param BrandService $service
     */
    public function __construct(
        protected BrandService $service,
    )
    {
    }

    /**
     * Список всех марок автомобилей
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $brands = $this->service->all();

        return response()->json($brands);
    }
}
