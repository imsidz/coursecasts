<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Faker\Factory as Faker;

abstract class BaseDiscussionSeeder extends Seeder
{
    abstract protected function discussionId(): int;
    abstract protected function title(): string;
    abstract protected function topicId(): int;
    abstract protected function postFile(): string;
    abstract protected function tagNames(): array;

    public function run(): void
    {
        $discussionId = $this->discussionId();
        $title = $this->title();
        $topicId = $this->topicId();
        $postFile = $this->postFile();
        $tagNames = $this->tagNames();

        // Insert or update discussion
        DB::table('discussions')->updateOrInsert(
            ['id' => $discussionId],
            [
                'title' => $title,
                'topic_id' => $topicId,
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $posts = include database_path("data/{$postFile}");
        $faker = Faker::create();
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = now()->subDays(rand(2, 5))->startOfDay();
        $currentTime = $baseDay->copy();
        $createdPostIds = [];
        $visibleLimit = rand(5, 10);

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 3))->addMinutes(rand(1, 25));

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

        // Set solution post
        DB::table('discussions')->where('id', $discussionId)->update([
            'solution_post_id' => $createdPostIds[0],
        ]);

        // Attach tags
        $tagIds = collect($tagNames)->map(function ($tagName) {
            return Tag::firstOrCreate(
                ['slug' => \Str::slug($tagName)],
                ['name' => $tagName]
            )->id;
        });

        DB::table('discussion_tag')->where('discussion_id', $discussionId)->delete();
        foreach ($tagIds as $tagId) {
            DB::table('discussion_tag')->insert([
                'discussion_id' => $discussionId,
                'tag_id' => $tagId,
            ]);
        }

        $this->command->info("✅ Seeded " . count($posts) . " posts to discussion '{$title}' (ID {$discussionId})");
        $this->command->info("🟢 First {$visibleLimit} visible. Solution set to post ID: {$createdPostIds[0]}");
        $this->command->info("🏷️ Tags applied: " . implode(', ', $tagNames));
    }
}
