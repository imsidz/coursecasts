<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmotionalIntelligenceSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 824],
            [
                'topic_id' => 19,
                'title' => 'Why emotional intelligence matters in IT',
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Load posts from static file
        $posts = include database_path('data/posts_emotional_intelligence.php');

        // Normalize and assign discussion_id
        foreach ($posts as &$post) {
            $post['discussion_id'] = 824;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post); // break reference

        // Filter out any post missing a user_id
        $posts = array_filter($posts, fn($p) => isset($p['user_id']));

        // Insert into posts table
        DB::table('posts')->insert($posts);
    }
}
