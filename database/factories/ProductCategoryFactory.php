<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'language' => 'en',
            'translation_group_id' => $this->faker->uuid,
            'parent_id' => null,
            'order' => $this->faker->numberBetween(1, 100),
            'icon' => $this->faker->optional()->word,
            'description' => $this->faker->optional()->paragraph,
            'user_id' => User::factory(),
            'seo_data' => [
                'title' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
            ],
        ];
    }

    public function withParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => ProductCategory::factory(),
            ];
        });
    }
};
