<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HtmlBoilerplateSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion exists and is visible
        DB::table('discussions')->updateOrInsert(
            ['id' => 671],
            [
                'topic_id'   => 18,
                'title'      => 'HTML Boilerplate for Beginners',
                'visible'    => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from file
        $posts = include database_path('data/html_boilerplate_discussion_671.php');

        // Assign discussion_id and ensure timestamps
        foreach ($posts as &$post) {
            $post['discussion_id'] = 671;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['visible'] = $post['visible'] ?? false;
        }
        unset($post); // clear reference

        // Insert into the posts table
        DB::table('posts')->insert($posts);
    }
}
