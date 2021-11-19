<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterSuccess()
    {
        $response = $this->postJson('/register', [
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => 'password',
            'avatar_image' => 'avatar_image',
            'profile' => '初めまして。userです',
            'freezing_status' => '1',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => '作成成功しました。']);
    }
}
