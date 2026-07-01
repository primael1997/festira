<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(800, 600, 'nature'),
            'content' => fake()->paragraphs(5, true),
        ];
    }
}
