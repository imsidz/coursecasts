<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthVsJWTSeeder extends Seeder
{
    public function run()
    {
        // Ensure discussion is visible and up-to-date
        DB::table('discussions')->updateOrInsert(
            ['id' => 140],
            [
                'topic_id' => 5,
                'title' => 'OAuth vs. JWT: Which One Is Better for API Security?',
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Load posts from file
        $rawPosts = include database_path('data/posts_oauth_vs_jwt_discussion.php');

        // Process posts safely
        $posts = [];

        foreach ($rawPosts as $post) {
            // Validate required fields
            if (!isset($post['user_id']) || !$post['user_id']) {
                continue; // skip if no valid user
            }

            $posts[] = [
                'body' => $post['body'],
                'user_id' => $post['user_id'],
                'visible' => $post['visible'] ?? false,
                'created_at' => $post['created_at'] ?? now(),
                'updated_at' => $post['updated_at'] ?? now(),
                'discussion_id' => 140,
            ];
        }

        // Insert into DB
        DB::table('posts')->insert($posts);
    }
}
