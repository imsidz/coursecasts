<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsHandlingApisFlutterSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('📥 Seeding posts for "Handling APIs with Flutter"...');

        $posts = include database_path('data/posts_handling_apis_flutter.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 863, // Discussion ID
                'user_id'       => $postData['user_id'],
                'body'          => $postData['body'],
                'visible'       => $postData['visible'],
                'created_at'    => Carbon::parse($postData['created_at']),
                'updated_at'    => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Handling APIs with Flutter" seeded successfully.');
    }
}
