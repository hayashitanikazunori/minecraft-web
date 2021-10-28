<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            //
        ]);
    }
}
