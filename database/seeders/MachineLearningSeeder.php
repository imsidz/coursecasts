<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Faker\Factory as Faker;

abstract class MachineLearningSeeder extends Seeder
{
    protected int $discussionId;
    protected string $title;
    protected int $topicId = 17;
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
                'created_at' => Carbon::create(2025, 6, 1),
                'updated_at' => Carbon::create(2025, 6, 1),
            ]
        );

        $posts = include database_path('data/' . $this->postFile);
        $faker = Faker::create();

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $currentTime = Carbon::create(2025, 6, 1, 8, 0);
        $createdPostIds = [];
        $visibleLimit = rand(5, 10);

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 2))->addMinutes(rand(1, 25));

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

        $tagIds = collect($this->tagNames)->map(function ($tag) {
            return Tag::firstOrCreate(['slug' => \Str::slug($tag)], ['name' => $tag])->id;
        });

        DB::table('discussion_tag')->where('discussion_id', $this->discussionId)->delete();
        foreach ($tagIds as $tagId) {
            DB::table('discussion_tag')->insert([
                'discussion_id' => $this->discussionId,
                'tag_id' => $tagId,
            ]);
        }

        $this->command->info("✅ Seeded " . count($posts) . " posts to '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("🟢 First {$visibleLimit} visible. Solution ID: {$createdPostIds[0]}");
        $this->command->info("🏷️ Tags: " . implode(', ', $this->tagNames));
    }
}
