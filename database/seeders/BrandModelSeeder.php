<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandModelSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Prius'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE'],
            'Audi' => ['A4', 'A6', 'Q5', 'Q7'],
            'Ford' => ['Focus', 'Fiesta', 'Mustang', 'Explorer'],
        ];

        foreach ($brands as $brandName => $models) {
            $brand = Brand::create(['name' => $brandName]);
            foreach ($models as $modelName) {
                CarModel::create([
                    'name' => $modelName,
                    'brand_id' => $brand->id,
                ]);
            }
        }
    }
}
