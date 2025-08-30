<?php

namespace App\Http\Controllers;

use App\Services\CarModelService;
use Illuminate\Http\JsonResponse;

class CarModelController extends Controller
{
    /**
     * @param CarModelService $service
     */
    public function __construct(
        protected CarModelService $service,
    )
    {
    }

    /**
     * Список всех моделей автомобилей с привязкой к маркам
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $models = $this->service->all();
        return response()->json($models);
    }
}
