<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;

class CarController extends Controller
{
    /**
     * @param CarService $service
     */
    public function __construct(
        protected CarService $service,
    )
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->service->getAll());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $data = $this->service->create($request->all());
            return response()->json($data, 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }


    /**
     * Получить автомобиль по ID
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = $this->service->getById($id);

        return response()->json($car);
    }

    /**
     * Обновить автомобиль
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $carData = $this->service->update($id, $request->all());

            return response()->json($carData);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Удалить автомобиль
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(null, 204);
    }
}
