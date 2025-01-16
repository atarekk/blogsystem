<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        $faker = \Faker\Factory::create();

        // Create 5 posts for admin
        for ($i = 1; $i <= 5; $i++) {

            Post::create([
                'title' => "Admin Post $i",
                'content' => "This is post $i created by the admin.",
                'featured_image_path' => null,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now(),
            ]);
        }

        // Create 6 posts for regular user
        for ($i = 1; $i <= 6; $i++) {

            Post::create([
                'title' => "User Post $i",
                'content' => "This is post $i created by a regular user.",
                'featured_image_path' => null,
                'author_id' => $user->id,
                'is_published' => ($i % 2 == 0),
                'published_at' => ($i % 2 == 0) ? now() : null,
            ]);
        }
    }



}
