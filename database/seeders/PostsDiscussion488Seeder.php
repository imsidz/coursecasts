<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion488Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 488;
        $posts = require database_path('data/488_discussion_posts_with_user_id.php');

        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'discussion_id' => $discussionId,
                'user_id'       => $post['user_id'],
                'parent_id'     => null,
                'body'          => $post['body'],
                'visible'       => true,
                'created_at'    => $post['created_at'],
                'updated_at'    => $post['updated_at'],
            ]);
        }
    }
}