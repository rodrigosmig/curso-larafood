<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * Error Get All Products
     *
     * @return void
     */
    public function testErrorGetAllProducts()
    {
        $tenant = 'fake_value';

        $response = $this->getJson("/api/v1/products?company_token={$tenant}");

        $response->assertStatus(422);
    }

    /**
     * Get All Products
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/products?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Not Found Product
     *
     * @return void
     */
    public function testNotFoundProduct()
    {
        $tenant     = factory(Tenant::class)->create();
        $product    = 'fake_value';

        $response = $this->getJson("/api/v1/products/{$product}?company_token={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Product By Identify
     *
     * @return void
     */
    public function testGetProductByIdentify()
    {
        $tenant     = factory(Tenant::class)->create();
        $product    = factory(Product::class)->create();

        $response = $this->getJson("/api/v1/products/{$product->uuid}?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
