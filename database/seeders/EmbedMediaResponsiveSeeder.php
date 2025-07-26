<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmbedMediaResponsiveSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 672],
            [
                'topic_id' => 18,
                'title' => 'How to Embed Media Responsively in HTML?',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load the static posts from the file
        $posts = include database_path('data/posts_embed_media_responsive.php');

        // Normalize and inject the discussion_id into each post
        foreach ($posts as &$post) {
            $post['discussion_id'] = 672;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();

            // Ensure 'user_id' is valid (in case it was set as `true` or invalid)
            if (!is_numeric($post['user_id']) || $post['user_id'] < 1) {
                $post['user_id'] = rand(1, 70); // fallback to random valid ID
            }
        }
        unset($post);

        // Insert posts
        DB::table('posts')->insert($posts);
    }
}
