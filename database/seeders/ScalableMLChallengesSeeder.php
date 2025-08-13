<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ScalableMLChallengesSeeder extends Seeder
{
    public function run()
    {
        // Create or update the discussion
        DB::table('discussions')->updateOrInsert(
            ['id' => 589],
            [
                'topic_id' => 17,
                'title' => 'Challenges in Implementing Scalable ML Algorithms on Big Data',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data
        $posts = include database_path('data/posts_scalable_ml_challenges.php');

        // Normalize and validate post data
        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || !is_numeric($post['user_id'])) {
                continue;
            }

            $post['visible'] = $post['visible'] ?? false;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['discussion_id'] = 589;

            // Ensure no unexpected keys like topic_id or stray data
            $post = Arr::only($post, [
                'body', 'user_id', 'visible', 'created_at', 'updated_at', 'discussion_id'
            ]);
        }
        unset($post);

        // Filter out invalid or incomplete posts
        $validPosts = array_filter($posts, function ($post) {
            return isset($post['user_id']) && isset($post['body']);
        });

        // Insert into DB
        DB::table('posts')->insert($validPosts);
    }
}
