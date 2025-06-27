<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\Discussion;

class PostsRealTimeVsBatchSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Real-Time vs. Batch Processing"...');

        $posts = include database_path('data/posts_real_time_vs_batch.php');

        // Ensure the discussion exists
        $discussion = Discussion::firstOrCreate(
            ['id' => 274],
            [
                'user_id' => 1,
                'topic_id' => 8,
                'title' => 'Real-Time vs. Batch Processing: Which Is Better for Your Use Case?',
                'slug' => 'real-time-vs-batch-processing',
                'visible' => true,
                'created_at' => Carbon::parse('2025-05-01 08:00:00'),
                'updated_at' => Carbon::parse('2025-05-01 08:00:00'),
            ]
        );

        foreach ($posts as $index => $postData) {
            $userId = rand(25, 65); // Random user ID between 25–65
            $visible = $index < 5; // First 5 posts are visible

            Post::create([
                'user_id' => $userId,
                'discussion_id' => $discussion->id,
                'body' => $postData['body'],
                'visible' => $visible,
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Real-Time vs. Batch Processing" seeded.');
    }
}
