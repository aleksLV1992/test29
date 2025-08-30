<?php

declare(strict_types=1);

namespace Feature\Api;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_can_create_car()
    {
        $brand = Brand::factory()->create();
        $model = CarModel::factory()->create(['brand_id' => $brand->id]);

        $data = [
            'brand_id' => $brand->id,
            'model_id' => $model->id,
            'year' => 2020,
            'mileage' => 50000,
            'color' => 'Red',
        ];

        $response = $this->postJson('/api/cars', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['color' => 'Red']);
    }

    /**
     * @return void
     */
    public function test_can_list_cars()
    {
        Car::factory()->count(3)->create();

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
