<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NervousInterviewSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 830],
            [
                'topic_id' => 19,
                'title' => 'How to handle being nervous in interviews',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from file
        $posts = include database_path('data/posts_nervous_interviews.php');

        // Normalize and assign discussion ID
        foreach ($posts as &$post) {
            $post['discussion_id'] = 830;
            $post['visible'] = $post['visible'] ?? false;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();

            // Optional: assign a fallback user if missing or invalid
            if (!isset($post['user_id']) || $post['user_id'] < 1 || $post['user_id'] > 70) {
                $post['user_id'] = rand(1, 70);
            }
        }
        unset($post);

        // Insert into database
        DB::table('posts')->insert($posts);
    }
}
