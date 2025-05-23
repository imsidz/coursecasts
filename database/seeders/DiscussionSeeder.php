<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DiscussionSeeder extends Seeder
{
    protected int $discussionId;
    protected string $title;
    protected int $topicId;
    protected string $postFile;

    public function run(): void
    {
        if (!isset($this->discussionId, $this->title, $this->topicId, $this->postFile)) {
            $this->command->error("Seeder properties not set.");
            return;
        }

        DB::table('discussions')->updateOrInsert(
            ['id' => $this->discussionId],
            [
                'title' => $this->title,
                'topic_id' => $this->topicId,
                'visible' => true,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $posts = include database_path('data/' . $this->postFile);
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
                'discussion_id' => $this->discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index < $visibleLimit,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        DB::table('discussions')->where('id', $this->discussionId)->update([
            'solution_post_id' => $createdPostIds[0],
        ]);

        $this->command->info("✅ Seeded " . count($posts) . " posts to discussion '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("🟢 First 5 visible. Solution set to post ID: {$createdPostIds[0]}");
    }
}
