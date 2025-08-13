<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion489Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 489;
        include database_path('data/discussion_489_flatten_posts.php');

        foreach ($posts as $post) {
            DB::table('posts')->insert([
                'discussion_id' => $discussionId,
                'user_id'       => $post['user_id'],
                'parent_id'     => null,
                'body'          => $post['content'],
                'visible'       => true,
                'created_at'    => $post['created_at'],
                'updated_at'    => $post['created_at'],
            ]);
        }
    }
}