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

        // Normalize and fill in required fields
        foreach ($posts as &$post) {
            $post['visible'] = true;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
            $post['discussion_id'] = $post['discussion_id'] ?? 1; // Default discussion ID
        }
        unset($post); // Unset reference

        // Insert posts into the database
        DB::table('posts')->insert($posts);

        DB::table('discussions')
            ->where('id', 1)
            ->update(['visible' => true]);
    }
}

