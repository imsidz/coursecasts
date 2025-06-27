<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsHtml5InputTypesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌐 Seeding posts for "Understanding HTML5 Input Types"...');

        $posts = include database_path('data/posts_html5_input_types.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 669, // ID for "Understanding HTML5 Input Types" discussion
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for HTML5 input types seeded successfully.');
    }
}
