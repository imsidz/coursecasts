<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion551Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 551;
        $posts = require database_path('/data/discussion_551_how_to_optimize_resource_allocation_for_big_data_workloads_in_kubernetes_posts.php');

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
