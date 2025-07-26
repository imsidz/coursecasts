<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Discussion;

class PostsVersioningRestfulApiSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("🚀 Seeding posts for 'Versioning in RESTful APIs: Best Practices'...");

        // Ensure the discussion is visible
        Discussion::where('id', 137)->update(['visible' => true]);

        $posts = include database_path('data/posts_versioning_restful_api.php');
        $discussionId = 137;

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => $discussionId,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info("✅ Seeded 40 posts for discussion ID {$discussionId}.");
    }
}
