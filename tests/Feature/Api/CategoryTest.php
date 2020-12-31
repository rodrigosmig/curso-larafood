<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * Error Get Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

    /**
     * Get All Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Get Category by Tenant.
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $tenant     = factory(Tenant::class)->create();
        $category   = 'fake_value';

        $response = $this->getJson("/api/v1/categories/{$category}?company_token={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Error Get Category by Tenant.
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $tenant     = factory(Tenant::class)->create();
        $category   = factory(Category::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
