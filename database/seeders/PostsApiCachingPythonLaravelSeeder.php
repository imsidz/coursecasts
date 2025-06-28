<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsApiCachingPythonLaravelSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "How to Handle API Caching in Python and Laravel"...');

        $posts = include database_path('data/posts_api_caching_python_laravel.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 159,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Done seeding posts for Discussion ID 159.');
    }
}
