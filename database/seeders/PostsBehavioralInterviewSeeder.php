<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsBehavioralInterviewSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🧠 Seeding posts for "How to prepare for behavioral interview questions?"');

        $posts = include database_path('data/posts_behavioral_interview_questions.php');

        $discussionId = 819;
        $userIds = range(25, 65); // 41 users

        foreach ($posts as $index => $postData) {
            Post::create([
                'discussion_id' => $discussionId,
                'user_id' => $userIds[$index % count($userIds)],
                'body' => $postData['body'],
                'visible' => $postData['visible'],
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded successfully.');
    }
}
