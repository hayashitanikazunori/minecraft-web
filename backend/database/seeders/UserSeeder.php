<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            //
        ]);
    }
}
