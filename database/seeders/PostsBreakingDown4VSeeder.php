<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsBreakingDown4VSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "Breaking Down the 4 V\'s of Big Data"...');

        $posts = include database_path('data/posts_breaking_down_4v_big_data.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 7,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded for discussion 7 successfully.');
    }
}
