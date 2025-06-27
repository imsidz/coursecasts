<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsIsBigDataAlwaysBetterSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Is Big Data Always Better Data?"...');

        $posts = include database_path('data/posts_is_big_data_always_better.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 6,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Is Big Data Always Better Data?" seeded successfully.');
    }
}
