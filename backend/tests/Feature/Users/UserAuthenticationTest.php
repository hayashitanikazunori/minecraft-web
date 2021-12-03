<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserLoginSuccess()
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'ログインしました。']);
    }

    public function testUserLoginFailed()
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/login', [
            'email' => 'user@example.com',
            'password' => 'passwordfailed',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'メールアドレスかパスワードが間違っています。']);
    }

    public function testUserLogoutSuccess()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertFalse(Auth::check());
        $response->assertStatus(200);
        $response->assertJson(['message' => 'ログアウトしました。']);
    }

    public function testUserLogoutFailed()
    {
        $response = $this->post('/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
