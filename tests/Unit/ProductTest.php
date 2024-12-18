<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User; // Import the User model
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function test_add_product()
    {
        $data = [
            'name' => 'test product',
            'price' => 500,
            'quantity' => 5,
        ];
        $response = $this->withoutMiddleware()->post(route('products.store'), $data);
        $response->dump();
        $this->assertDatabaseHas('products', [
            'name' => 'test product',
        ]);
    }
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
