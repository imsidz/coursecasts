<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;

class LaravelOctaneSeeder extends Seeder
{
    protected int $discussionId = 324;
    protected string $title = 'Laravel Octane: Boosting Microservices Performance';
    protected int $topicId = 10;
    protected array $tagNames = ['laravel', 'octane', 'microservices'];
    protected string $postFile = 'laravel_octane_posts.php';

    public function run(): void
    {
        // Insert or update the discussion
        DB::table('discussions')->updateOrInsert(
            ['id' => $this->discussionId],
            [
                'title'      => $this->title,
                'topic_id'   => $this->topicId,
                'visible'    => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Load posts
        $posts = include database_path('data/' . $this->postFile);
        $faker = Faker::create();

        // Get enough users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Time simulation
        $baseDay = now()->subDays(rand(2, 5))->startOfDay();
        $currentTime = $baseDay->copy();
        $createdPostIds = [];

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 2))->addMinutes(rand(1, 15));

            $post = Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => $this->discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index === 0, // First only
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        // Set first post as solution
        DB::table('discussions')->where('id', $this->discussionId)->update([
            'solution_post_id' => $createdPostIds[0],
        ]);

        // Attach tags
        $tagIds = collect($this->tagNames)->map(function ($tag) {
            return Tag::firstOrCreate(
                ['slug' => \Str::slug($tag)],
                ['name' => $tag]
            )->id;
        });

        DB::table('discussion_tag')->where('discussion_id', $this->discussionId)->delete();
        foreach ($tagIds as $tagId) {
            DB::table('discussion_tag')->insert([
                'discussion_id' => $this->discussionId,
                'tag_id' => $tagId,
            ]);
        }

        $this->command->info("✅ Seeded 40 posts to discussion '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("🟢 First post visible. Solution post ID: {$createdPostIds[0]}");
        $this->command->info("🏷️ Tags applied: " . implode(', ', $this->tagNames));
    }
}
