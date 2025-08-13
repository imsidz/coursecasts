<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsyncCodeJSSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 688],
            [
                'topic_id' => 18,
                'title' => 'How to Handle Asynchronous Code in JS?',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from static PHP file
        $posts = include database_path('data/posts_async_js_688.php');

        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || !is_numeric($post['user_id'])) {
                continue;
            }

            $post['discussion_id'] = 688;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        $posts = array_filter($posts, fn ($p) => isset($p['user_id']) && is_numeric($p['user_id']));

        DB::table('posts')->insert($posts);
    }
}
