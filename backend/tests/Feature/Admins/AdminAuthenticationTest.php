<?php

namespace Tests\Feature\Admins;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginSuccess()
    {
        Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'ログインしました']);
    }

    public function testLoginFailed()
    {
        Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/admin/login', [
            'email' => 'failed@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(500);
        $response->assertJson(['message' => 'ログインに失敗しました。再度お試しください']);
    }

    public function testLogoutSuccess()
    {
        $adminUser = Admin::factory()->create();

        $response = $this->actingAs($adminUser)
            ->post('/admin/logout');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'ログアウトしました']);
    }

}
