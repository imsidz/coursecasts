<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion554Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 554;
        $posts = require database_path('/data/discussion_554_challenges_in_managing_resource_contention_in_kubernetes_clusters_posts.php');

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
