<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZIndexStackingSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 679],
            [
                'topic_id' => 18,
                'title' => 'Understanding z-index and Stacking Context',
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Load posts
        $posts = include database_path('data/posts_z_index_679.php');

        // Normalize data
        foreach ($posts as &$post) {
            $post['discussion_id'] = 679;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}
