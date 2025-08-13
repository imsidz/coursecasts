<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthDiscussionSeeder extends Seeder
{
    public function run()
    {
        // Load post data from external file
        $posts = include database_path('data/posts_oauth_discussion.php');

        // Assign discussion_id = 138 and fill required fields
        foreach ($posts as &$post) {
            $post['visible'] = true;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['discussion_id'] = 138;
        }
        unset($post); // Unset reference to avoid potential bugs

        // Insert posts into the database
        DB::table('posts')->insert($posts);

        // Ensure the discussion itself is marked as visible
        DB::table('discussions')->where('id', 138)->update(['visible' => true]);
    }
}
