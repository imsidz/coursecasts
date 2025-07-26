<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaResponsiveSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 672],
            [
                'topic_id'   => 18,
                'title'      => 'How to Embed Media Responsively in HTML?',
                'visible'    => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from file
        $posts = include database_path('data/media_responsive_discussion_672.php');

        // Enrich each post with discussion ID and timestamps if missing
        foreach ($posts as &$post) {
            $post['discussion_id'] = 672;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        // Insert posts into database
        DB::table('posts')->insert($posts);
    }
}
