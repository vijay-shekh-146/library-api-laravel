<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    public function test_user_can_register()
    {
        $userData = User::factory()->make()->toArray();
        $response = $this->postJson('/api/register', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => 'password',
            'role_id' => 2
        ]);

        $response->assertStatus(201)
                    ->assertJsonStructure([
                        'message',
                        'user' => ['id', 'name', 'email']
                    ]);
    }

    public function test_user_can_login_and_receive_token()
    {
    
        $response = $this->postJson('/api/login', [
            'email' => "admin@library.com",
            'password' => 'password'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'expires_in'
                 ]);
    }


    public function test_login_fails_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => "admin@library.com",
            'password' => 'passwordtest'
        ]);

        $response->assertStatus(401)
                 ->assertJson(['status' => false,'message'=>'Invalid credentials']);
    }

     public function test_user_can_logout()
    {
        $user = User::where('email', 'admin@library.com')->first();
        $token = auth()->tokenById($user->id);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Successfully logged out']);
    }
}
