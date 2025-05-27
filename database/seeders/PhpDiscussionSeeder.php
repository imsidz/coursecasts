<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;

class PhpDiscussionSeeder extends Seeder
{
    public function run(): void
    {
        // Update discussion title and visibility
        \DB::table('discussions')->where('id', 51)->update([
            'title' => 'PHP cURL Basics: How to Send HTTP Requests',
            'visible' => true,
        ]);

        $faker = Faker::create();

        $posts = [
            "When working with paginated APIs, always check for `next` or `has_more` indicators in the response.",
            "In PHP, cURL is great for API requests — just remember to handle pagination loops properly.",
            "We use a while loop with cURL to keep requesting pages until we hit an empty result set.",
            "Most APIs use query parameters like `?page=2` or `?offset=20&limit=10` for pagination.",
            "Always set a max page limit in your script to avoid infinite loops or API bans.",
            "We log the current page and response status on each request to debug pagination issues.",
            "Some APIs return pagination data in headers — don't forget to inspect those!",
            "cURL handles each request independently — you'll need to build logic to stitch paginated results.",
            "Use `json_decode(\$response, true)` to easily extract pagination tokens from JSON APIs.",
            "We use Guzzle now, but cURL taught us the foundations of pagination handling.",
            "Respect rate limits during pagination — add a delay between requests when needed.",
            "Handling `next_url` links returned by APIs makes pagination cleaner than page numbers.",
            "Always validate API responses before parsing — some pages might return errors or partial data.",
            "Paginated responses are great for memory management — fetch only what you need.",
            "If the API returns a total count, use it to calculate the number of pages in advance.",
            "We wrap our pagination logic in a function so we can reuse it across multiple APIs.",
            "Some APIs allow both cursor and offset pagination — choose based on performance needs.",
            "When APIs return IDs instead of page numbers, store the last ID to continue from there.",
            "We ran into bugs by not checking if `data` existed before looping — guard against nulls!",
            "Always catch cURL errors — don't assume every page will return cleanly.",
            "To test pagination, limit pages to 3 and print results before scaling up.",
            "Use `CURLOPT_URL` dynamically with each page to automate cURL pagination.",
            "APIs sometimes stop returning data before expected — add safety checks.",
            "If you're scraping paginated APIs, check if the structure changes mid-way.",
            "We built a recursive paginator in PHP to handle nested paginated API calls.",
            "Avoid hardcoding page counts — instead, use API metadata to navigate.",
            "Debugging with `curl_getinfo()` helped us understand response timing during pagination.",
            "We cache each page response locally to speed up testing and retry logic.",
            "Make sure your pagination doesn't cause duplicates — key your results correctly.",
            "Some APIs use tokens instead of page numbers — store and reuse them carefully.",
            "Combine pagination with `limit` parameters to control payload size and memory.",
            "We built a CLI tool in PHP to fetch paginated data and export it as CSV.",
            "Cursor-based pagination is more reliable when data is changing often.",
            "When paginating thousands of items, split requests over time to reduce load.",
            "cURL doesn't support cookies by default — some paginated APIs require session handling.",
            "Always set timeouts in cURL — pagination loops can hang on slow APIs.",
            "Be prepared for inconsistent page sizes if the API changes midway.",
            "In some cases, you can batch pages asynchronously — but not with raw cURL.",
            "We used a progress bar in the CLI to visualize pagination progress in real time.",
            "Our scraper died halfway through because of a missing pagination check — lessons learned.",
            "Don't forget to document your pagination logic — it's often where bugs live."
        ];

        // Assign users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Pick a single day to simulate all posts on
        $baseDay = now()->subDays(rand(5, 10))->startOfDay();
        $currentTime = $baseDay->copy();

        foreach ($posts as $index => $body) {
            // Add 2–3 hours per post
            $currentTime->addHours(rand(2, 3));

            $visible = $index < 10;

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => 51,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);
        }

        $this->command->info("✅ Seeded 40 PHP cURL posts (10 visible) to discussion ID 51.");
    }
}
