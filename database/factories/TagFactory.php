<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'language' => 'en',
            'translation_group_id' => $this->faker->uuid,
            'user_id' => User::factory(),
        ];
    }
};
