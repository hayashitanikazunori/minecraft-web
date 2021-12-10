<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    public function run()
    {
        $turnNumber = [1, 2, 3, 4, 5];

        DB::table('favorites')->insert([
            [
                'id' => $turnNumber[0],
                'user_id' => $turnNumber[0],
                'post_id' => $turnNumber[0],
            ],
            [
                'id' => $turnNumber[1],
                'user_id' => $turnNumber[1],
                'post_id' => $turnNumber[1],
            ],
            [
                'id' => $turnNumber[2],
                'user_id' => $turnNumber[2],
                'post_id' => $turnNumber[2],
            ],
            [
                'id' => $turnNumber[3],
                'user_id' => $turnNumber[3],
                'post_id' => $turnNumber[3],
            ],
            [
                'id' => $turnNumber[4],
                'user_id' => $turnNumber[4],
                'post_id' => $turnNumber[4],
            ],
        ]);
    }
}
