<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostsHowToStructureSemanticHtmlSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "How to Structure a Semantic HTML Page"...');

        $posts = include database_path('data/posts_how_to_structure_semantic_html.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 666,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Done: Posts seeded for discussion ID 666.');
    }
}
