<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsFlutterAppDeploymentGuideSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Flutter App Deployment Guide"...');

        $posts = include database_path('data/posts_flutter_app_deployment_guide.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 872, // Discussion ID for "Flutter App Deployment Guide"
                'user_id'       => $postData['user_id'],
                'body'          => $postData['body'],
                'visible'       => $postData['visible'],
                'created_at'    => Carbon::parse($postData['created_at']),
                'updated_at'    => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Flutter App Deployment Guide" seeded successfully.');
    }
}
