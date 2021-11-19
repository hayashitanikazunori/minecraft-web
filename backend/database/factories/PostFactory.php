<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->realText(20, 5),
            'thumbnail_images' => 'TRgnw2T9d9YXg7PChKQgdA6KgitkdLzHmQVQhZ2p.jpg',
            'description' => $this->faker->realText(255, 5),
            'material' => $this->faker->realText(255, 5),
            'recipe' => $this->faker->realText(500, 5),
            'publicing_status' => 0,
            'user_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
