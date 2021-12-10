<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year', '-1day');

        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'post_id' => $this->faker->numberBetween(1, 3),
            'body' => $this->faker->realText(100, 5),
            'created_at' => $random_date,
            'updated_at' => $random_date,
        ];
    }
}
