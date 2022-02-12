<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    public function test_login_requires_creds()
    {
        $response = $this->postJson('api/login');
        
        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Unauthorised.',
            ]);
    }
    
    
    public function test_user_logins_successfully()
    {
        // User from seed:
        
        $user = User::first();
        
        $payload = ['email' => 'admin@test.com', 'password' => 'password'];

        $response = $this->postJson('/api/login', $payload);
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);

    }
}
