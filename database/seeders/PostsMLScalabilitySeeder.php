<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\Discussion;

class PostsMLScalabilitySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🧠 Seeding posts for "What Makes a Machine Learning Algorithm Scalable for Big Data?"...');

        $posts = include database_path('data/posts_machine_learning_scalability.php');

        // Ensure the discussion exists
        $discussion = Discussion::firstOrCreate(
            ['id' => 577],
            [
                'user_id' => 1,
                'topic_id' => 17,
                'title' => 'What Makes a Machine Learning Algorithm Scalable for Big Data?',
                'slug' => 'what-makes-a-machine-learning-algorithm-scalable-for-big-data',
                'visible' => true,
                'created_at' => Carbon::parse('2025-06-07 08:00:00'),
                'updated_at' => Carbon::parse('2025-06-07 08:00:00'),
            ]
        );

        foreach ($posts as $index => $postData) {
            Post::create([
                'discussion_id' => $discussion->id,
                'user_id' => rand(25, 65),
                'body' => $postData['body'],
                'visible' => $index < 5,
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded for ML scalability discussion.');
    }
}