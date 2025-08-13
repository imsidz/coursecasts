<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion487Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 487;
        $posts = require database_path('/data/487_discussion_posts.php');

        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'discussion_id' => $discussionId,
                'user_id'       => $post['user_id'] ?? 1,
                'parent_id'     => null,
                'body'          => $post['content'],
                'visible'       => true,
                'created_at'    => $post['created_at'],
                'updated_at'    => $post['created_at'],
            ]);
        }
    }
}