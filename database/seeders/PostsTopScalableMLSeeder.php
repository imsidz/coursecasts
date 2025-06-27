<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsTopScalableMLSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding posts for "Top Scalable Machine Learning Algorithms for Distributed Systems"...');

        $posts = include database_path('data/posts_top_scalable_ml_algorithms.php');
        $discussionId = 578;

        foreach ($posts as $index => $data) {
            Post::create([
                'user_id' => rand(25, 65),
                'discussion_id' => $discussionId,
                'body' => $data['body'],
                'visible' => $index < 5,
                'created_at' => Carbon::parse($data['created_at']),
                'updated_at' => Carbon::parse($data['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded successfully.');
    }
}
