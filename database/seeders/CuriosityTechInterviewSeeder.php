<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuriosityTechInterviewSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is created and visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 821],
            [
                'title' => 'How to show curiosity during a tech interview',
                'topic_id' => 19,
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from data file
        $posts = include database_path('data/posts_curiosity_tech_interview.php');

        // Normalize fields and assign discussion_id
        foreach ($posts as &$post) {
            $post['discussion_id'] = 821;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        // Insert into posts table
        DB::table('posts')->insert($posts);
    }
}
