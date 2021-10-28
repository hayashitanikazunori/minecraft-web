<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
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
