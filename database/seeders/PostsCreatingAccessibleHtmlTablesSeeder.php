<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsCreatingAccessibleHtmlTablesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('⏱️ Seeding posts for "Creating Accessible HTML Tables"...');

        $posts = include database_path('data/posts_creating_accessible_html_tables.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 670,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Creating Accessible HTML Tables" seeded successfully.');
    }
}
