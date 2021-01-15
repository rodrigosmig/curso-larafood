<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Table;
use App\Models\Client;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * Validation Create New Order.
     *
     * @return void
     */
    public function testValidationCreateNewOrder()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
                ->assertJsonPath('errors.company_token', [trans('validation.required', ['attribute' => 'company token'])])
                ->assertJsonPath('errors.products', [trans('validation.required', ['attribute' => 'products'])]);
        
    }

    /**
     * Create New Order.
     *
     * @return void
     */
    public function testCreateNewOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'company_token' => $tenant->uuid,
            'products'      => []
        ];

        $products = factory(Product::class, 5)->create();

        foreach ($products as $product) {
            $payload['products'][] = [
                'identify' => $product->uuid,
                'quantity' => 2
            ];
        }        

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
        
    }

    /**
     * Total Order.
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'company_token' => $tenant->uuid,
            'products'      => []
        ];

        $products = factory(Product::class, 2)->create([
            'price' => 10.50
        ]);

        foreach ($products as $product) {
            $payload['products'][] = [
                'identify' => $product->uuid,
                'quantity' => 1
            ];
        }        

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
                ->assertJsonPath('data.total', 21);
    }

    /**
     * Order Not Found.
     *
     * @return void
     */
    public function testOrderNotFound()
    {
        $order = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }

    /**
     * Total Get Order.
     *
     * @return void
     */
    public function testGetOrder()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);     
        
    }

    /**
     * Test Create New Order Authenticated.
     *
     * @return void
     */
    public function testCreateNewOrderAuthenticated()
    {
        $client = factory(Client::class)->create();
        $token  = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = factory(Tenant::class)->create();

        $payload = [
            'company_token' => $tenant->uuid,
            'products'      => []
        ];

        $products = factory(Product::class, 2)->create();

        foreach ($products as $product) {
            $payload['products'][] = [
                'identify' => $product->uuid,
                'quantity' => 2
            ];
        }        

        $response = $this->postJson('/api/auth/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201)
                ->assertJsonPath('data.client', [
                    'name' => $client->name,
                    'email' => $client->email
                ]);
    }

    /**
     * Test Create New Order With Table.
     *
     * @return void
     */
    public function testeCreateNewOrderWithTable()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();

        $payload = [
            'company_token' => $tenant->uuid,
            'products'      => [],
            'table'         => $table->uuid
        ];

        $products = factory(Product::class, 2)->create();

        foreach ($products as $product) {
            $payload['products'][] = [
                'identify' => $product->uuid,
                'quantity' => 2
            ];
        }        

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Test Get My Orders.
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        $client = factory(Client::class)->create();
        $token  = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = factory(Tenant::class)->create();

        factory(Order::class, 4)->create([
            'client_id' => $client->id
        ]);

        $response = $this->getJson('/api/auth/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                ->assertJsonCount(4, 'data');
    }
}
