<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostsBigDataInAIMLSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for discussion: "The Role of Big Data in AI & ML"...');

        $posts = include database_path('data/posts_big_data_in_ai_ml.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 5, // The discussion ID for this topic
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Finished seeding posts for Big Data in AI & ML.');
    }
}
