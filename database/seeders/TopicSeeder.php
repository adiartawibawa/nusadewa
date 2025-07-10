<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run()
    {
        // Ambil user ID atau buat satu jika belum ada
        $userIds = User::pluck('id');
        if ($userIds->isEmpty()) {
            $userIds = collect([User::factory()->create()->id]);
        }

        $topics = collect([
            'Breeding Techniques',
            'Disease Management',
            'Feed Technology',
            'Water Quality',
            'Farm Management',
            'Genetic Improvement',
        ]);

        $topics->each(function ($name) use ($userIds) {
            Topic::create([
                'name' => $name,
                'user_id' => $userIds->random(),
            ]);
        });
    }
}
