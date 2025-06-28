<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsNodeApiAuthSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Node.js API Authentication: Passport.js or JWT?"...');

        $posts = include database_path('data/posts_node_api_auth_passport_jwt.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 163,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'] ?? false,
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for Node.js API Authentication discussion seeded.');
    }
}
