<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CSSBoxModelSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is present and visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 684],
            [
                'topic_id'   => 18,
                'title'      => 'CSS Box Model Explained Clearly',
                'visible'    => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from PHP file
        $posts = include database_path('data/css_box_model_684.php');

        foreach ($posts as &$post) {
            $post['discussion_id'] = 684;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();

            // Fallback if user_id is somehow invalid
            if (!isset($post['user_id']) || !is_numeric($post['user_id'])) {
                $post['user_id'] = rand(80, 120);
            }

            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        // Insert posts
        DB::table('posts')->insert($posts);
    }
}
