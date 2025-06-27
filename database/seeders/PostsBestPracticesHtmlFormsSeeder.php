<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsBestPracticesHtmlFormsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Seeding posts for "Best Practices for HTML Forms"...');

        $posts = include database_path('data/posts_best_practices_html_forms.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 667, // Discussion ID for "Best Practices for HTML Forms"
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Best Practices for HTML Forms" seeded successfully.');
    }
}
