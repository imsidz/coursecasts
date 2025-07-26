<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthDiscussionSeeder extends Seeder
{
    public function run()
    {
        $posts = include database_path('data/posts_oauth_discussion.php');

        // Force 'visible' to true for all posts
        $posts = array_map(function ($post) {
            $post['visible'] = true;
            return $post;
        }, $posts);

        DB::table('posts')->insert($posts);
    }
}