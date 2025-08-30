<?php
declare(strict_types=1);

namespace App\Services;

use App\Data\CarData;
use App\Repositories\CarRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CarService
{
    public function __construct(
        protected CarRepository $repository
    ) {
    }

    /**
     * Возвращает только автомобили текущего пользователя
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->repository->allByUser(Auth::id());
    }

    /**
     *
     * @param int $id
     * @return CarData
     */
    public function getById(int $id): CarData
    {
        $data = $this->repository->findByIdAndUser($id, Auth::id());
        if (!$data) {
            abort(404, 'Автомобиль не найден или доступ запрещён');
        }
        return $data;
    }

    /**
     * Создаёт автомобиль и привязывает к текущему пользователю
     *
     * @param array $data
     * @return CarData
     */
    public function create(array $data): CarData
    {
        $validator = Validator::make($data, [
            'brand_id' => 'required|exists:brands,id',
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();
        $validated['user_id'] = Auth::id(); // Привязка к пользователю

        return $this->repository->create($validated);
    }

    /**
     *
     * @param int $id
     * @param array $data
     * @return CarData
     */
    public function update(int $id, array $data): CarData
    {
        $car = $this->repository->findByIdAndUser($id, Auth::id());
        if (!$car) {
            abort(404, 'Автомобиль не найден или доступ запрещён');
        }

        $validator = Validator::make($data, [
            'brand_id' => 'sometimes|exists:brands,id',
            'car_model_id' => 'sometimes|exists:car_models,id',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($id, $validator->validated());
    }

    /**
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $car = $this->repository->findByIdAndUser($id, Auth::id());
        if (!$car) {
            abort(404, 'Автомобиль не найден или доступ запрещён');
        }

        $this->repository->deleteById($id);
    }
}
