<?php

namespace Database\Factories;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year', '-1day');

        return [
            'user_id' => 1,
            'post_id' => 1,
            'created_at' => $random_date,
            'updated_at' => $random_date,
        ];
    }
}
