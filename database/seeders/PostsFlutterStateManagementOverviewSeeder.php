<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsFlutterStateManagementOverviewSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "Flutter State Management Overview"...');

        $posts = include database_path('data/posts_flutter_state_management_overview.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 860,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Finished seeding posts for discussion 870.');
    }
}
