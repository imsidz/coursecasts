<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SearchEngineDiscussionSeeder extends Seeder
{
    public function run(): void
    {
        $discussionId = 181; // ⬅️ Change if needed
        $topicId = 7;
        $title = 'What Is a Search Engine and How Does It Work?';

        DB::table('discussions')->updateOrInsert(
            ['id' => $discussionId],
            [
                'title' => $title,
                'topic_id' => $topicId,
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $posts = $this->loadPosts();
        $faker = Faker::create();

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = now()->subDays(rand(5, 10))->startOfDay();
        $currentTime = $baseDay->copy();

        $visibleLimit = 5;
        $createdPostIds = [];

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 3));

            $post = Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => $discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index < $visibleLimit,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        DB::table('discussions')
            ->where('id', $discussionId)
            ->update(['solution_post_id' => $createdPostIds[0]]);

        $this->command->info("✅ Seeded 40 posts to discussion ID $discussionId.");
        $this->command->info("🟢 First 5 are visible. Solution set to post ID: {$createdPostIds[0]}");
    }

    private function loadPosts(): array
    {
        return include database_path('data/search_engine_posts.php');
    }
}
