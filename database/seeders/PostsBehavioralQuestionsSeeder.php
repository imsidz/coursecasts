<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;

class PostsBehavioralQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Seeding posts for "How to prepare for behavioral interview questions?"');

        $posts = include database_path('data/posts_behavioral_interview_questions.php');
        $discussionId = 819;

        foreach ($posts as $index => $data) {
            DB::table('posts')->insert([
                'user_id' => rand(25, 65),
                'discussion_id' => $discussionId,
                'body' => $data['body'],
                'visible' => $index < 5, // First 5 posts visible
                'created_at' => Carbon::parse($data['created_at']),
                'updated_at' => Carbon::parse($data['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded for discussion 819.');
    }
}
