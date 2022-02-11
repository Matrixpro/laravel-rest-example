<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * This class describes an api vehicle endpoint test.
 * 
 * NOTE: Test user and vehicles are seeded. See /tests/TestCase.php
 */
class ApiVehicleEndpointTest extends TestCase
{
    use WithFaker;
    
    /**
     * Tests that a user can get a list of vehicles using the API
     *
     * @return void
     */
    public function test_user_can_get_vehicles()
    {
        $user = User::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        // Optional Params:
        
        $payload = [
            'per_page' => 10,
            'order_by' => 'make',
            'order_direction' => 'DESC',
        ];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->getJson('/api/vehicles', $payload);
        
        $response_c->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'path',
                'per_page',
                'next_page_url',
                'prev_page_url',
            ]);
    }
    
    /**
     * Tests that a user can create a vehicle using the API
     *
     * @return void
     */
    public function test_user_can_create_a_vehicle()
    {
        $user = User::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        $payload = [
            'make' => 'Honda',
            'year' => '2022',
            'model' => 'Accord',
            'type' => $this->faker->randomElement(['used','new']),
            'msrp' => $this->faker->randomFloat(2, 0, 100000),
            'miles' => $this->faker->randomNumber(),
            'vin' => $this->faker->randomNumber(),
        ];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->postJson('/api/vehicles', $payload);
        
        $response_c->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
    /**
     * Tests that a user can update/put a vehicle using the API
     *
     * @return void
     */
    public function test_user_can_put_a_vehicle()
    {
        $user = User::first();
        $vehicle = Vehicle::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        $payload = [
            'make' => 'HondaY',
            'year' => '2028',
            'model' => 'AccordY',
            'type' => $this->faker->randomElement(['used','new']),
            'msrp' => $this->faker->randomFloat(2, 0, 100000),
            'miles' => $this->faker->randomNumber(),
            'vin' => $this->faker->randomNumber(),
        ];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->putJson('/api/vehicles/'.$vehicle->id, $payload);
        
        $response_c->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
    /**
     * Tests that a user can search for vehicles using the API
     *
     * @return void
     */
    public function test_user_can_search_vehicles()
    {
        $user = User::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        $payload = [
            'search_for' => 'honda',
            'search_in' => 'make',
        ];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->getJson('/api/vehicles', $payload);
        
        $response_c->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'path',
                'per_page',
                'next_page_url',
                'prev_page_url',
            ]);
    }
    /**
     * Tests that a user can update/patch a vehicle using the API
     *
     * @return void
     */
    public function test_user_can_patch_a_vehicle()
    {
        $user = User::first();
        $vehicle = Vehicle::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        $payload = [
            'make' => 'HondaX',
            'year' => '2023',
        ];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->patchJson('/api/vehicles/'.$vehicle->id, $payload);
        
        $response_c->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
    /**
     * Tests that a user can get a vehicle using the API
     *
     * @return void
     */
    public function test_user_can_get_a_vehicle()
    {
        $user = User::first();
        $vehicle = Vehicle::first();
        
        // Login to get token
        
        $payload = ['email' => $user->email, 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
        
        $content = $response->decodeResponseJson();
        
        $token = $content['data']['token'];
        
        $response_c = $this->withHeaders(['Authorization' => 'Bearer '.$token ])
            ->getJson('/api/vehicles/'.$vehicle->id);
        
        $response_c->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
                'message',
            ]);
    }
}
