<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text' => fake()->text(400)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post){
            Comment::factory(2)
                ->for($post)
                ->for(User::inRandomOrder()->first(), 'owner')
                ->create();

            $post->userLiked()->syncWithoutDetaching(User::inRandomOrder()->limit(fake()->numberBetween(0, 5))->get());
        });
    }
}
