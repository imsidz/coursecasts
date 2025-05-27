<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;

class APISeeder extends Seeder
{
    public function run(): void
    {
        $discussionId = (int) env('SEED_DISCUSSION_ID');

        $topics = [
            // 135 => [
            //     'title' => 'RESTful APIs: Resource Naming Conventions and URL Structure',
            //     'posts' => $this->resourceNamingPosts(),
            // ],
            136 => [
                'title' => 'Statelessness in REST APIs: Why Does It Matter',
                'posts' => $this->statelessnessPosts(),
            ],
        ];

        if (!isset($topics[$discussionId])) {
            $this->command->warn("⚠️ No valid SEED_DISCUSSION_ID. Use 135 or 136.");
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

        // Count how many posts are already visible within the past 24 hours
        $visibleInLast24h = \App\Models\Post::where('discussion_id', $discussionId)
            ->where('visible', true)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        $allowedVisible = max(0, 5 - $visibleInLast24h);

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(2, 3));

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => $discussionId,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $index < $allowedVisible,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);
        }

        $this->command->info("✅ Seeded " . count($posts) . " posts to discussion ID $discussionId.");
        $this->command->info("🕓 Only $allowedVisible new post(s) set as visible (max 5 every 24h).");
    }

    private function statelessnessPosts(): array
    {
        return [
            "Statelessness means each API request must contain all the info needed to process it.",
            "REST APIs are stateless by design — the server does not remember previous requests.",
            "You can’t rely on sessions or server memory to store user state in RESTful APIs.",
            "Stateless APIs simplify horizontal scaling since any server can handle any request.",
            "Stateless design improves fault tolerance — no server affinity needed.",
            "All client context should be passed in headers, tokens, or the request body.",
            "Authentication is often stateless via JWTs or API tokens.",
            "Stateful APIs make load balancing harder — you need sticky sessions or shared memory.",
            "Stateless APIs reduce server complexity and memory usage.",
            "Debugging is easier with stateless APIs because each request is isolated.",
            "Caching is more predictable in stateless APIs since responses depend only on input.",
            "A stateless API does not store client context — that’s the client’s job.",
            "Stateless communication enables retry logic without fear of side effects.",
            "Statelessness aligns with the REST constraint of uniform interface.",
            "In stateless APIs, session data is often encoded in the client-side token.",
            "Don’t mix stateless endpoints with stateful ones unless absolutely necessary.",
            "APIs should never assume prior requests — each call must be independent.",
            "When designing mobile or SPA clients, statelessness simplifies reconnection logic.",
            "A stateless server doesn’t require memory of previous actions — that’s powerful.",
            "You can simulate session-like behavior in stateless APIs with metadata in each request.",
            "Client state is often saved in localStorage or cookies, then sent with each request.",
            "A stateless API still maintains application state — just not between requests.",
            "You gain scalability at the cost of convenience when going stateless.",
            "It’s easier to reason about failures when APIs are stateless.",
            "Stateless APIs require idempotent design for safety on retries.",
            "Each API request should include authentication and any required identifiers.",
            "Statelessness makes integration with edge functions and CDNs easier.",
            "Error handling is cleaner when the server doesn’t need to track client progress.",
            "Avoid storing authentication context in the backend for stateless APIs.",
            "Statelessness makes your API easier to mock, test, and document.",
            "State should be handled either by the client or external services like Redis or databases.",
            "Stateless APIs help keep microservices truly independent.",
            "Long-lived connections (like WebSockets) don’t follow REST statelessness rules.",
            "Statelessness is a cornerstone of the REST architectural style.",
            "Even though stateless APIs don't remember you, they can still authorize you per request.",
            "JWT expiration and refresh flows must be handled on the client in stateless setups.",
            "Statelessness reduces complexity in CI/CD pipelines by removing persistent session management.",
            "Retry-safe design is critical in stateless services, especially for payment gateways.",
            "Each REST call should act as if it’s the only interaction ever made by the client.",
            "Stateless APIs are not just a preference — they’re often a necessity at scale."
        ];
    }
}
