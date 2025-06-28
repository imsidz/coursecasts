<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsWorkingWithCombineFrameworkSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Working with Combine Framework in iOS"...');

        $posts = include database_path('data/posts_working_with_combine_framework.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 890,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Working with Combine Framework in iOS" seeded successfully.');
    }
}
