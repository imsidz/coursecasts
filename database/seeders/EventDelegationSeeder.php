<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventDelegationSeeder extends Seeder
{
    public function run()
    {
        // Ensure the discussion is visible and exists
        DB::table('discussions')->updateOrInsert(
            ['id' => 687],
            [
                'topic_id' => 18,
                'title' => 'Understanding Event Delegation in JavaScript',
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load post data from the file
        $posts = include database_path('data/event_delegation_687.php');

        // Normalize fields
        foreach ($posts as &$post) {
            if (!isset($post['user_id']) || $post['user_id'] === true) {
                $post['user_id'] = rand(121, 160); // fallback
            }

            $post['visible'] = $post['visible'] ?? false;
            $post['discussion_id'] = 687;
            $post['created_at'] = $post['created_at'] ?? now();
            $post['updated_at'] = $post['updated_at'] ?? now();
        }
        unset($post);

        // Insert posts
        DB::table('posts')->insert($posts);
    }
}
