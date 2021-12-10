<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginedPostGetSuccess()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);


        $response = $this->get("/posts/{$post->id}");
        $response->assertStatus(200);
    }

    public function testLoginedPutUpdateSuccess()
    {
        /*************************************************
         * TODO
         * このままだとthumbnail_imagesがエラーになる。
         * Postのmodelファイル”$image_path”をコメントアウトして、
         * 直$request['thumbnail_images']に変更すればテストが通る。
         * Fakerを使ってダミー画像を使うにはDockerFileを調整する必要がある。
        *************************************************/

        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put("/posts/{$post->id}", [
            'title' => 'タイトル名変更',
            'thumbnail_images' => "TRgnw2T9d9YXg7PChKQgdA6KgitkdLzHmQVQhZ2p.jpg",
            'description' => '概要変更',
            'material' => '材料変更',
            'recipe' => 'レシピ変更',
        ]);
        $response->assertStatus(200);
    }
}
