<?php

namespace Tests\Feature\Admins;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\Post;

class AdminOperatePostsTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginedPostsGetSuccess()
    {
        $adminUser = Admin::factory()->create();
        $response = $this->actingAs($adminUser)
        ->get('/admin/posts');

        $response->assertStatus(200);
    }

    public function testNotLoginedPostsGetFailed()
    {
        $response = $this->get('/admin/posts');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function testLoginedPostsChangePublicingStatusSuccess()
    {
        $adminUser = Admin::factory()->create();
        $user = User::factory()->create();
        Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($adminUser)
        ->post('/admin/posts/1/change-publicing-status');

        $response->assertStatus(200);
        $response->assertJson(['message' => '公開ステータスの変更に成功しました。']);
    }

    public function testNotLoginedPostsChangePublicingStatusFailed()
    {
        $user = User::factory()->create();
        Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->post('/admin/posts/1/change-publicing-status');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function testLoginedPostDestroySuccess()
    {
        $adminUser = Admin::factory()->create();
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'id' => 1,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($adminUser)
        ->delete('/admin/posts/1');

        $this->assertDeleted($post);
        $response->assertStatus(200);
        $response->assertJson(['message' => '投稿の削除に成功しました。']);
    }

    public function testNotLoginedPostDestroyFailed()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'id' => 1,
            'user_id' => $user->id,
        ]);

        $response = $this->delete('/admin/posts/1');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }
}
