<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::pluck('id');
        if ($userIds->isEmpty()) {
            $userIds = collect([User::factory()->create()->id]);
        }

        $tags = collect([
            'Shrimp Breeding',
            'Aquaculture',
            'Genetics',
            'Sustainability',
            'Innovation',
            'Technology',
            'Research',
            'Farming',
            'Health',
            'Nutrition',
        ]);

        $tags->each(function ($name) use ($userIds) {
            Tag::create([
                'name' => $name,
                'user_id' => $userIds->random(),
            ]);
        });
    }
}
