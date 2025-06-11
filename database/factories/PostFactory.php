<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'language' => 'en',
            'translation_group_id' => $this->faker->uuid,
            'type' => $this->faker->randomElement(['post', 'page', 'product', 'landing']),
            'is_featured' => $this->faker->boolean(20),
            'summary' => $this->faker->paragraph,
            'body' => $this->faker->text(2000),
            'published_at' => $this->faker->optional(70)->dateTimeBetween('-1 year', '+1 year'),
            'featured_image' => $this->faker->optional()->imageUrl(),
            'featured_image_caption' => $this->faker->optional()->sentence,
            'user_id' => User::factory(),
            'meta' => [
                'key1' => $this->faker->word,
                'key2' => $this->faker->word,
            ],
            'seo_data' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
            ],
            'indexable' => $this->faker->boolean(80),
        ];
    }
};
