<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Models\Topic;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Nusa Dewa',
            'email' => 'admin@nusadewa.test',
            'password' => Hash::make('password')
        ]);

        $this->call([
            TeamMemberSeeder::class,
            PostSeeder::class,
        ]);

        $this->command->info('Database seeded successfully!');
    }
}
