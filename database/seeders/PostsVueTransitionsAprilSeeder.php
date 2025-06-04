<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Discussion;

class PostsVueTransitionsAprilSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌸 Seeding posts for "Vue Transition and Animation Basics"...');

        // Ensure the discussion exists
        $discussion = Discussion::firstOrCreate(
            ['id' => 805],
            [
                'user_id' => 1, // Adjust as needed
                'topic_id' => 18,
                'title' => 'Vue Transition and Animation Basics',
                'slug' => 'vue-transition-and-animation-basics',
                'visible' => true,
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ]
        );

        $posts = include database_path('data/posts_vue_transitions_april.php');

        foreach ($posts as $postData) {
            DB::table('posts')->insert([
                'discussion_id' => $discussion->id,
                'user_id' => rand(1, 40),
                'body' => $postData['body'],
                'visible' => $postData['visible'] ?? false,
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts seeded successfully for "Vue Transition and Animation Basics".');
    }
}
