<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year', '-1day');

        return [
            'title' => $this->faker->realText(20, 5),
            'thumbnail_images' => 'TRgnw2T9d9YXg7PChKQgdA6KgitkdLzHmQVQhZ2p.jpg',
            'description' => $this->faker->realText(255, 5),
            'material' => $this->faker->realText(255, 5),
            'recipe' => $this->faker->realText(500, 5),
            'publicing_status' => 0,
            'user_id' => $this->faker->numberBetween(1, 3),
            'created_at' => $random_date,
            'updated_at' => $random_date,
        ];
    }
}
