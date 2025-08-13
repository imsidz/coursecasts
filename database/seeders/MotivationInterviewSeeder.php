<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivationInterviewSeeder extends Seeder
{
    public function run()
    {
        // Ensure discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 820],
            [
                'topic_id' => 19,
                'title' => 'Demonstrating motivation in a job interview',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from flat PHP file
        $posts = include database_path('data/posts_motivation_discussion.php');

        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || !$post['user_id']) {
                continue; // skip incomplete posts
            }

            $post['discussion_id'] = 820;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
        }
        unset($post);

        // Remove skipped/null entries
        $posts = array_filter($posts);

        // Insert into DB
        DB::table('posts')->insert($posts);
    }
}
