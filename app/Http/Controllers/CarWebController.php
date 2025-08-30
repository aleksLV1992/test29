<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use App\Services\CarModelService;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CarWebController extends Controller
{
    /**
     * @param CarService $carService
     * @param BrandService $brandService
     * @param CarModelService $carModelService
     */
    public function __construct(
        protected CarService      $carService,
        protected BrandService    $brandService,
        protected CarModelService $carModelService,
    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $cars = $this->carService->getAll();
        return view('cars.index', compact('cars'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $brands = $this->brandService->all();
        $models = $this->carModelService->all();

        return view('cars.create', compact('brands', 'models'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->carService->create($request->all());
            return redirect()->route('cars.index')->with('success', 'Автомобиль успешно добавлен.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $car = $this->carService->getById($id)->toArray();
        $brands = $this->brandService->all();
        $models = $this->carModelService->all();

        return view('cars.edit', compact('car', 'brands', 'models'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $this->carService->update($id, $request->all());
            return redirect()->route('cars.index')->with('success', 'Автомобиль успешно обновлён.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->carService->delete($id);
        return redirect()->route('cars.index')->with('success', 'Автомобиль удалён.');
    }
}
