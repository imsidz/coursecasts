<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfidentNotArrogantSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 827],
            [
                'topic_id' => 19,
                'title' => 'How to appear confident without being arrogant',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from file
        $posts = include database_path('data/posts_confident_not_arrogant.php');

        foreach ($posts as &$post) {
            $post['discussion_id'] = 827;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}
