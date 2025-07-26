<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaQueries682Seeder extends Seeder
{
    public function run()
    {
        // Make sure the discussion is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 682],
            [
                'topic_id' => 18,
                'title' => 'Media Queries: Making Your Site Mobile-Friendly',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from file
        $posts = include database_path('data/media_queries_682.php');

        // Normalize post data
        foreach ($posts as &$post) {
            $post['discussion_id'] = 682;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}
