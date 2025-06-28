<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsCssVariablesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Seeding posts for "CSS Variables: Why and How to Use Them"...');

        $posts = include database_path('data/posts_css_variables_why_and_how.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 681,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "CSS Variables" discussion seeded.');
    }
}
