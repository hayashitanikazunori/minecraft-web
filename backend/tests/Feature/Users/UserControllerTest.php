<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserLogoutSuccess()
    {
        $user = User::factory()->create();

        $response = $this->get('/user/{$user->id}');

        $response->assertStatus(404);
    }

}
