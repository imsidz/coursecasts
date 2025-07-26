<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThinkingSeniorDeveloperSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 822],
            [
                'title' => 'Thinking like a senior developer — where to start?',
                'topic_id' => 19,
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from file
        $posts = include database_path('data/posts_thinking_like_senior.php');

        // Attach discussion_id and normalize
        foreach ($posts as &$post) {
            $post['discussion_id'] = 822;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}
