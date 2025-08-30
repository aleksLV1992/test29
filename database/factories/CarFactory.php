<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'model_id' => CarModel::factory(),
            'year' => $this->faker->numberBetween(2000, 2025),
            'mileage' => $this->faker->numberBetween(0, 300000),
            'color' => $this->faker->colorName,
        ];
    }
}
