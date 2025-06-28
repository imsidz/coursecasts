<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsDivVsSectionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌿 Seeding posts for "When to Use div vs section in HTML?"...');

        $posts = include database_path('data/posts_div_vs_section.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 668,
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "div vs section" seeded.');
    }
}
