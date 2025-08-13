<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagsSeoSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 673],
            [
                'topic_id' => 18,
                'title' => 'HTML Meta Tags That Matter for SEO',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data
        $posts = include database_path('data/posts_meta_tags_seo.php');

        // Normalize posts
        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || !is_numeric($post['user_id'])) {
                continue; // Skip posts without a valid user_id
            }

            $post['discussion_id'] = 673;
            $post['visible'] = $post['visible'] ?? false;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
        }
        unset($post);

        // Insert posts
        DB::table('posts')->insert($posts);
    }
}
