<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableTest extends TestCase
{
    /**
     * Error Get Tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    /**
     * Get All Tables by Tenant.
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Get Table by Tenant.
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $tenant     = factory(Tenant::class)->create();
        $table   = 'fake_value';

        $response = $this->getJson("/api/v1/tables/{$table}?company_token={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Error Get Table by Tenant.
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $tenant  = factory(Tenant::class)->create();
        $table   = factory(Table::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?company_token={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
