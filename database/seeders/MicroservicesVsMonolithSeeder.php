<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class MicroservicesVsMonolithSeeder extends Seeder
{
    protected int $discussionId = 304;
    protected string $title = 'Microservices vs. Monolithic: Which One Is Right for Your Application?';
    protected int $topicId = 10;
    protected array $tagNames = ['microservices', 'monolithic'];
    protected string $postFile = 'microservices_vs_monolith_posts.php';

    public function run(): void
    {
        // Update or create discussion
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

        // Get or create users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Time simulation
        $baseDay = now()->subDays(rand(3, 7))->startOfDay();
        $currentTime = $baseDay->copy();
        $createdPostIds = [];

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(1, 2))->addMinutes(rand(2, 25));

            $post = Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => $this->discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index === 0, // Only first is visible
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        // Mark solution post
        DB::table('discussions')->where('id', $this->discussionId)->update([
            'solution_post_id' => $createdPostIds[0],
        ]);

        // Attach tags to discussion
        $tagIds = collect($this->tagNames)->map(function ($name) {
            $slug = \Str::slug($name);
            return Tag::firstOrCreate(['slug' => $slug], ['name' => $name])->id;
        });

        DB::table('discussion_tag')->where('discussion_id', $this->discussionId)->delete();

        foreach ($tagIds as $tagId) {
            DB::table('discussion_tag')->insert([
                'discussion_id' => $this->discussionId,
                'tag_id' => $tagId,
            ]);
        }

        $this->command->info("✅ Seeded 40 posts to discussion '{$this->title}' (ID {$this->discussionId})");
        $this->command->info("🟢 First post visible. Solution set to post ID: {$createdPostIds[0]}");
        $this->command->info("🏷️ Tags applied: " . implode(', ', $this->tagNames));
    }
}
