<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Discussion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsHowToGetStartedBigDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "How to Get Started with Big Data?"...');

        // Make sure discussion is visible
        Discussion::where('id', 3)->update(['visible' => true]);

        $posts = include database_path('data/posts_how_to_get_started_big_data.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 3, // Discussion ID for this topic
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded and discussion is now visible.');
    }
}
