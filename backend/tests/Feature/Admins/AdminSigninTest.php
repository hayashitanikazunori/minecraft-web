<?php

namespace Tests\Feature\Admins;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminSigninTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインページが正常に表示されるか
     */
    public function testAdminSigninPageView()
    {
        $response = $this->get('/admin/signin');

        $response->assertStatus(200);
        // $response->dumpHeaders();

        // $response->dumpSession();

        // $response->dump();

    }

    /**
     * 正常な入力値の状態で、ログイン処理が正しく行われるか
     */
    public function testAdminSignin()
    {
        $adminUser = Admin::factory(Admin::class)->create([
            'email' => 'admin@example.com',
            'password'  => bcrypt('password')
        ]);


        $response = $this->post('/admin/signin', [
            'email' => 'admin@exmaple.com',
            'password' => 'password'
        ]);

        $response->assertAuthenticatedAs($adminUser);
        // $response->dumpHeaders();

    }

}
