<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;

class DockerTopicSeeder extends Seeder
{
    public function run(): void
    {
        $discussionId = (int) env('SEED_DISCUSSION_ID');

        $topics = [
            173 => [
                'title' => 'how-docker-simplifies-application-deployment',
                'posts' => $this->deploymentPosts(),
            ],
            178 => [
                'title' => 'how-to-install-docker-on-windows-macos-and-linux',
                'posts' => $this->installationPosts(),
            ],
        ];

        if (!isset($topics[$discussionId])) {
            $this->command->warn("⚠️ Invalid SEED_DISCUSSION_ID. Available: " . implode(', ', array_keys($topics)));
            return;
        }

        $topic = $topics[$discussionId];

        \DB::table('discussions')->where('id', $discussionId)->update([
            'title' => $topic['title'],
            'visible' => true,
        ]);

        $faker = Faker::create();
        $posts = $topic['posts'];

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = now()->subDays(rand(5, 10))->startOfDay();
        $currentTime = $baseDay->copy();

        $visibleInLast24h = Post::where('discussion_id', $discussionId)
            ->where('visible', true)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        $allowedVisible = max(0, 5 - $visibleInLast24h);
        $createdPostIds = [];

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(2, 3));

            $post = Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => $discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index < $allowedVisible,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);

            $createdPostIds[] = $post->id;
        }

        // Set solution_post_id to the first created post
        \DB::table('discussions')->where('id', $discussionId)->update([
            'solution_post_id' => $createdPostIds[0] ?? null,
        ]);

        $this->command->info("✅ Seeded " . count($posts) . " posts to discussion ID $discussionId.");
        $this->command->info("🕓 Visible: $allowedVisible (max 5 per 24h).");
        $this->command->info("✅ Solution post set to ID: {$createdPostIds[0]}");
    }

    private function deploymentPosts(): array
    {
        return include database_path('data/docker_deployment_posts.php');
    }

    private function installationPosts(): array
    {
        return include database_path('data/docker_installation_posts.php');
    }
}
