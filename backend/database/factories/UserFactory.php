<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // $fakeUser = $this->faker->name();

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'avatar_image' => 'avatar_image',
            'profile' => "初めまして。",
            'freezing_status' => 0,
            'remember_token' => Str::random(10),
        ];
    }

    // public function fakeUser()
    // {
    //     $this->faker->name();
    // }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
