<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->jobTitle,
            'language' => 'en',
            'translation_group_id' => $this->faker->uuid,
            'bio' => $this->faker->paragraph,
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'order' => $this->faker->numberBetween(1, 20),
            'social_links' => [
                'twitter' => $this->faker->optional()->url,
                'linkedin' => $this->faker->optional()->url,
                'github' => $this->faker->optional()->url,
            ],
            'skills' => $this->faker->words(5),
            'is_active' => $this->faker->boolean(90),
            'user_id' => User::factory(),
        ];
    }
};
