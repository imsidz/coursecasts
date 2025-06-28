<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsPostmanApiTestingTipsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "Postman for API Testing: Tips and Tricks"...');

        $posts = include database_path('data/posts_postman_api_testing_tips.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 154, // ✅ Change this if your discussion ID differs
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Postman API Testing Tips" seeded successfully.');
    }
}
