<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;

class RealisticPostsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $posts = [
            "Web scraping is powerful, but scraping login-required sites without permission crosses a line.",
            "Always check a website's robots.txt — it's a basic first step in ethical scraping.",
            "I think scraping public data is fair game, but rate-limiting is a must.",
            "Legal issues start when scraping violates a site's terms of service.",
            "Scraping for academic research should still follow ethical boundaries.",
            "You can scrape data responsibly by using delay intervals and identifying your bot.",
            "Some companies open APIs to avoid scraping — a win-win!",
            "I've been blocked for scraping too fast — it's important to respect server resources.",
            "Web scraping helped me gather pricing data — but I had to ensure I wasn’t violating copyrights.",
            "There’s a thin line between scraping and data theft, especially with proprietary info.",
            "Scraping news headlines is different from copying full articles — the latter is copyright infringement.",
            "Captcha walls are a sign to stop — they’re a clear anti-scraping measure.",
            "Ethical scraping means respecting privacy — avoid collecting personal info without consent.",
            "Always include a user-agent string that identifies your script and contact info.",
            "I once asked a site owner for permission — and they gave me a private API instead!",
            "Web scraping is great for market research, but don't take content wholesale.",
            "If you're scraping job postings, watch out — many job boards explicitly forbid it.",
            "Scraping social media is legally gray and ethically tricky — user data deserves respect.",
            "Parsing HTML is fragile — APIs are more reliable and usually more legal.",
            "I used scraping to monitor legislation changes, but stuck to public government portals.",
            "Machine learning and scraping go hand-in-hand — but always check licensing!",
            "Never use scraped emails for marketing — that’s spam and often illegal.",
            "Sometimes scraping is allowed for personal use but banned for commercial purposes.",
            "It's easy to scrape, but that doesn't mean you should — always ask: who owns this data?",
            "Respecting rate limits avoids IP bans and builds trust.",
            "Automating browsers with tools like Puppeteer is powerful, but raises ethical flags fast.",
            "Scraping publicly listed data (like product specs) is often fine — but not guaranteed.",
            "I always document scraping steps so clients know it’s done ethically.",
            "There’s growing legal pressure around scraping — especially in the EU under GDPR.",
            "Before scraping, I research data licenses and copyright claims thoroughly.",
            "Use proxy rotation responsibly — it’s not a way to bypass rules, just prevent accidental bans.",
            "I treat web scraping like web crawling — transparency, respect, and caution are key.",
            "Some datasets are technically accessible but morally off-limits (e.g., mental health forums).",
            "If a site offers a public API, use that first — scraping is the last resort.",
            "Ethical scraping means you stop when asked — always.",
            "You can do a lot with scraping, but legal battles aren't worth it.",
            "Even for public datasets, I attribute sources when publishing scraped insights.",
            "Academic projects still need IRB or legal review if scraping involves people’s data.",
            "Just because it's on the web doesn't mean it's free to use — remember fair use limits.",
            "Being open about scraping policies in your code and documentation shows good intent.",
            "Teaching scraping responsibly is just as important as doing it responsibly.",
        ];

        // Make sure we have 40 users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Helper to spread posts across 4 weeks
        function weekRange(int $week): array
        {
            $start = now()->subWeeks(4 - $week)->startOfWeek();
            $end = $start->copy()->endOfWeek();
            return [$start, $end];
        }

        foreach ($posts as $index => $body) {
            $weekNumber = intdiv($index, 10) + 1; // Spread posts: 10 per week for 4 weeks
            [$start, $end] = weekRange($weekNumber);
            $created = $faker->dateTimeBetween($start, $end);

            $visible = $index < 10; // First 10 posts visible, rest hidden

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => 22, // Web scraping topic
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $created,
                'updated_at'    => $created,
            ]);
        }

        $this->command->info("✅ Seeded 40 web scraping posts (10 visible) to discussion ID 22.");
    }
}
