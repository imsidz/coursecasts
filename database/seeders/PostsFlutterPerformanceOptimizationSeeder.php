<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsFlutterPerformanceOptimizationSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Flutter Performance Optimization"...');

        $posts = include database_path('data/posts_flutter_performance_optimization.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 869,  // Discussion ID for Flutter Performance Optimization
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Flutter Performance Optimization" seeded.');
    }
}
