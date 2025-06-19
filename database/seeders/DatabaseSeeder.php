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

        // Create 10 team members
        // $teamMembers = TeamMember::factory()
        //     ->count(10)
        //     ->create();

        // Create 20 tags
        // $tags = Tag::factory()
        //     ->count(20)
        //     ->create();

        // Create 15 topics
        // $topics = Topic::factory()
        //     ->count(15)
        //     ->create();

        // Create 10 main product categories
        // $mainCategories = ProductCategory::factory()
        //     ->count(10)
        //     ->create();

        // Create 30 subcategories (children of main categories)
        // $subCategories = ProductCategory::factory()
        //     ->count(30)
        //     ->withParent()
        //     ->create();

        // Create 50 posts with relationships
        // $posts = Post::factory()
        //     ->count(50)
        //     ->create()
        //     ->each(function ($post) use ($tags, $topics, $mainCategories, $subCategories) {
        //         // Attach 1-3 random tags
        //         $post->tags()->attach(
        //             $tags->random(rand(1, 3))->pluck('id')->toArray()
        //         );

        //         // Attach 1-2 random topics
        //         $post->topics()->attach(
        //             $topics->random(rand(1, 2))->pluck('id')->toArray()
        //         );

        //         // Attach to 1-3 random categories (mix of main and sub)
        //         $allCategories = $mainCategories->merge($subCategories);
        //         $post->productCategories()->attach(
        //             $allCategories->random(rand(1, 3))->pluck('id')->toArray(),
        //             ['order' => rand(1, 10)]
        //         );
        //     });

        $this->command->info('Database seeded successfully!');
    }
}
