<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

abstract class BigDataSecuritySeeder extends Seeder
{
    protected int $discussionId;
    protected string $title;
    protected int $topicId = 14;
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

        $posts = include database_path('data/' . $this->postFile);
        $faker = Faker::create();

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = now()->subDays(rand(2, 5))->startOfDay();
        $currentTime = $baseDay->copy();
        $createdPostIds = [];
        $visibleLimit = 5;

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 2))->addMinutes(rand(5, 45));

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

        $this->command->info("\u2705 Seeded " . count($posts) . " posts to discussion '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("\ud83d\udfe2 First {$visibleLimit} visible. Solution set to post ID: {$createdPostIds[0]}");
        $this->command->info("\ud83c\udf7f Tags applied: " . implode(', ', $this->tagNames));
    }
}
