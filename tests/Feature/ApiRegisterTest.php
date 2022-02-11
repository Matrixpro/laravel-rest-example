<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiRegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $user_details = [
            'name' => 'Tester',
            'email' => 'tester@test.com',
            'password' => 'password',
            'confirm_password' => 'password',
        ];
        
        $response = $this->postJson('/api/register', $user_details);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ]
            ]);
    }
    
    public function test_register_requires_creds()
    {
        $response = $this->postJson('/api/register');
        
        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                "message" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ],
                    "confirm_password" => [
                        "The confirm password field is required."
                    ]
                ]
            ]);
    }
}
