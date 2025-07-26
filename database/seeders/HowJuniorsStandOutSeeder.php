<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HowJuniorsStandOutSeeder extends Seeder
{
    public function run()
    {
        // Create or update the discussion
        DB::table('discussions')->updateOrInsert(
            ['id' => 826],
            [
                'topic_id' => 19,
                'title' => 'How juniors can stand out with no experience',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load the flattened posts file
        $posts = include database_path('data/posts_how_juniors_stand_out.php');

        foreach ($posts as &$post) {
            // Ensure each post is tied to this discussion
            $post['discussion_id'] = 826;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post);

        // Insert the posts
        DB::table('posts')->insert($posts);
    }
}
