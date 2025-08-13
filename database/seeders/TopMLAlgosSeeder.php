<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopMLAlgosSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is created and visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 578],
            [
                'topic_id' => 17,
                'title' => 'Top Scalable Machine Learning Algorithms for Distributed Systems',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts from PHP array file
        $posts = include database_path('data/posts_ml_scalability_discussion.php');

        // Prepare posts for insertion
        foreach ($posts as &$post) {
            // Assign discussion ID
            $post['discussion_id'] = 578;

            // Default visible to false if not set
            $post['visible'] = $post['visible'] ?? false;

            // Ensure timestamps
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
        }
        unset($post);

        // Insert into database
        DB::table('posts')->insert($posts);
    }
}
