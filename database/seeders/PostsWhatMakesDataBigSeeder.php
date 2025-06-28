<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostsWhatMakesDataBigSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('📝 Seeding posts for "What Makes Data \'Big\'?" discussion...');

        $posts = include database_path('data/posts_what_makes_data_big.php');

        foreach ($posts as $postData) {
            Post::create([
                'discussion_id' => 4, // Discussion ID for "What Makes Data 'Big'?"
                'user_id' => $postData['user_id'],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "What Makes Data \'Big\'?" seeded successfully.');
    }
}
