<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            //
        ]);
    }
}
