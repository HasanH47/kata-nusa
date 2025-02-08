<?php

namespace Database\Factories;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'title' => $this->faker->sentence(),
            'summary' => $this->faker->sentence(),
            'thumbnail' => $this->faker->imageUrl(),
            'body' => $this->faker->paragraphs(5, true),
            'views' => $this->faker->numberBetween(1000, 10000),
            'likes' => $this->faker->numberBetween(0, 1000),
            'is_published' => true,
            'published_at' => Carbon::now(),
        ];
    }
}
