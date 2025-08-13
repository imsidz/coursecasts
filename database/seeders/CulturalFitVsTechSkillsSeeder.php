<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CulturalFitVsTechSkillsSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is marked visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 828],
            [
                'topic_id' => 19,
                'title' => 'Do companies value cultural fit over tech skills?',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load flattened posts array from file
        $posts = include database_path('data/posts_cultural_fit_vs_skills.php');

        foreach ($posts as &$post) {
            $post['discussion_id'] = 828;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}
