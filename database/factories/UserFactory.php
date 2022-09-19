<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'profile_picture' => 'picture_profile.png',
            'cover_picture' => 'picture_cover.jpeg',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // for ($i = 1; $i <= 15; $i++) {
            //     $user->find($i)->assignRole('user');
            // }
            // for ($i = 16; $i <= 20; $i++) {
            //     $user->find($i)->assignRole('admin');
            // // }
            Post::factory()
                ->count(1)
                ->for($user, 'owner')
                ->create();

                
        });
    }

    public function banned()
    {
        return $this->state(function (array $attributes) {
            return [
                'banned_at' => fake()->time(),
            ];
        });
    }
}
