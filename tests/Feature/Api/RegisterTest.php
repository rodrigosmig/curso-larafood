<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error Create New Client
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name'  => 'Test',
            'email' => 'test@test.com'
        ];
        $response = $this->postJson("/api/auth/register", $payload);

        $response->assertStatus(422)
                ->assertExactJson([
                    'errors' => [
                        'password' => [trans('validation.required', ['attribute' => 'password'])]
                    ],
                    "message" => "The given data was invalid."
                ]);
    }

    /**
     * Success Create New Client
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {
        $payload = [
            'name'      => 'Test',
            'email'     => 'test@test.com',
            'password'  => '12345678'
        ];
        $response = $this->postJson("/api/auth/register", $payload);

        $response->assertStatus(201)
                ->assertExactJson([
                    'data' => [
                        'name'      => 'Test',
                        'email'     => 'test@test.com',
                    ],
                ]);
    }
}
