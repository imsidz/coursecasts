<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsDiscussion548Seeder extends Seeder
{
    public function run()
    {
        $discussionId = 548;
        $posts = require database_path('/data/discussion_548_spark_performance_tuning_managing_executors_partitions_and_memory_posts.php');

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
