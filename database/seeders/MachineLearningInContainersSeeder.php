<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

abstract class MachineLearningInContainersSeeder extends Seeder
{
    protected int $discussionId;
    protected string $title;
    protected int $topicId = 15;
    protected array $tagNames;
    protected string $postFile;

    public function run(): void
    {
        DB::table('discussions')->updateOrInsert(
            ['id' => $this->discussionId],
            [
                'title' => $this->title,
                'topic_id' => $this->topicId,
                'visible' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $posts = include database_path("data/{$this->postFile}");
        $faker = Faker::create();

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = Carbon::create(2025, 5, 28, 0, 0);
        $currentTime = $baseDay->copy();
        $createdPostIds = [];

        $visibleCount = rand(3, 7);

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 2))->addMinutes(rand(1, 45));

            $post = Post::create([
                'user_id' => $userIds[$index],
                'discussion_id' => $this->discussionId,
                'parent_id' => null,
                'body' => $body,
                'visible' => $index < $visibleCount,
                'created_at' => $currentTime->copy(),
                'updated_at' => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        DB::table('discussions')->where('id', $this->discussionId)->update([
            'solution_post_id' => $createdPostIds[0],
        ]);

        // Tags
        $tagIds = collect($this->tagNames)->map(function ($tagName) {
            return Tag::firstOrCreate(
                ['slug' => \Str::slug($tagName)],
                ['name' => $tagName]
            )->id;
        });

        DB::table('discussion_tag')->where('discussion_id', $this->discussionId)->delete();

        foreach ($tagIds as $tagId) {
            DB::table('discussion_tag')->insert([
                'discussion_id' => $this->discussionId,
                'tag_id' => $tagId,
            ]);
        }

        $this->command->info("✅ Seeded " . count($posts) . " posts to discussion '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("🟢 First {$visibleCount} visible. Solution set to post ID: {$createdPostIds[0]}");
        $this->command->info("🏷️ Tags applied: " . implode(', ', $this->tagNames));
    }
}
