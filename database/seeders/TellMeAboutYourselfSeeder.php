<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TellMeAboutYourselfSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 825],
            [
                'topic_id' => 19,
                'title' => 'Tips for answering "Tell me about yourself"',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from the static array file
        $posts = include database_path('data/posts_tell_me_about_yourself.php');

        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || !$post['user_id']) {
                continue; // Skip any malformed post
            }

            $post['discussion_id'] = 825;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        // Remove any null entries
        $posts = array_filter($posts);

        // Insert posts into the database
        DB::table('posts')->insert($posts);
    }
}
