<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            //
        ]);
    }
}
