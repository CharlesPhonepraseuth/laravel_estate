<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_is_api_reachable(): void
    {
        $response = $this->get('/api/biens');

        $response->assertStatus(200);
    }

    public function test_ok_on_api_structure(): void
    {
        $response = $this->get('/api/biens');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'title', 'price', 'surface', 'options',
                ],
            ],
            'status',
        ]);
    }
}
