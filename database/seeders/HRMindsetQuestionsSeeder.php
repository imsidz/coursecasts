<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HRMindsetQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is created and visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 823],
            [
                'title' => 'HR questions that reveal your mindset',
                'topic_id' => 19,
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from data file
        $posts = include database_path('data/posts_hr_mindset_questions.php');

        // Normalize and attach discussion_id
        foreach ($posts as &$post) {
            $post['discussion_id'] = 823;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        DB::table('posts')->insert($posts);
    }
}