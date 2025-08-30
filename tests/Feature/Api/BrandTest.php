<?php

declare(strict_types=1);

namespace Feature\Api;

use App\Models\Brand;
use Tests\TestCase;

class BrandTest extends TestCase
{
    public function test_can_list_brands()
    {
        Brand::factory()->count(5)->create();

        $response = $this->getJson('/api/brands');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }
}
