<?php

namespace Tests\Feature\Admins;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class AdminOperateUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginedUsersGetSuccess()
    {
        $adminUser = Admin::factory()->create();
        $response = $this->actingAs($adminUser)
        ->get('/admin/users');

        $response->assertStatus(200);
    }

    public function testNotLoginedUsersGetFailed()
    {
        $response = $this->get('/admin/users');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function testLoginedUsersChangeFreezingStatusSuccess()
    {
        $adminUser = Admin::factory()->create();
        User::factory()->create([
            'id' => 1,
        ]);

        $response = $this->actingAs($adminUser)
        ->post('/admin/users/1/change-freezing-status');

        $response->assertStatus(200);
        $response->assertJson(['message' => '凍結ステータスの変更に成功しました。']);
    }

    public function testNotLoginedUsersChangeFreezingStatusFailed()
    {
        User::factory()->create();

        $response = $this->post('/admin/users/1/change-freezing-status');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function testLoginedUserDestroySuccess()
    {
        $adminUser = Admin::factory()->create();
        $user = User::factory()->create([
            'id' => 1,
        ]);

        $response = $this->actingAs($adminUser)
        ->delete('/admin/users/1');

        $this->assertDeleted($user);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'アカウントの削除に成功しました。']);
    }

    public function testNotLoginedUserDestroyFailed()
    {
        User::factory()->create();

        $response = $this->delete('/admin/users/1');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }
}
