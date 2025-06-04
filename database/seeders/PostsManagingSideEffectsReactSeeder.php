<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PostsManagingSideEffectsReactSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "Managing Side Effects in React"...');

        $posts = include database_path('data/posts_managing_side_effects_react.php');

        $discussionId = 815;

        foreach ($posts as $postData) {
            DB::table('posts')->insert([
                'discussion_id' => $discussionId,
                'user_id' => rand(1, 40),
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for React side effects discussion seeded successfully.');
    }
}
