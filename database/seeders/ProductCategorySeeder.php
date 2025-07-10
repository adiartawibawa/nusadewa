<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user_id atau buat satu jika belum ada
        $userIds = User::pluck('id');
        if ($userIds->isEmpty()) {
            $userIds = collect([User::factory()->create()->id]);
        }

        $categories = collect([
            'Shrimp Broodstock',
            'Shrimp Postlarvae',
            'Feed Additives',
            'Probiotics',
            'Water Treatment',
        ]);

        $categories->each(function ($name) use ($userIds) {
            ProductCategory::create([
                'name' => $name,
                'user_id' => $userIds->random(),
            ]);
        });
    }
}
