<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;



class WebScrapingDiscussionSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('discussions')->where('id', 22)->update(['visible' => true]);
        $faker = Faker::create();

        $posts = [
            "Always check a site's robots.txt before scraping — it's the ethical starting point.",
            "Web scraping is legal in many cases, but scraping personal data can violate privacy laws.",
            "Rate limiting and respecting terms of service are critical to avoid being blocked or sued.",
            "Some sites offer public APIs — use those when available instead of scraping raw HTML.",
            "Remember: scraping copyrighted content without permission may have legal consequences.",
            "We throttle our requests and randomize headers to avoid detection and minimize server load.",
            "Using headless browsers like Puppeteer makes scraping JS-heavy sites much easier.",
            "We got cease-and-desist emails for scraping — always consult a lawyer for legal gray areas.",
            "Data scraping is powerful, but unethical use (like price manipulation) can backfire.",
            "Captcha? Consider it a hint you’re not supposed to scrape that easily.",
            "The GDPR and CCPA change the rules — even IP addresses might count as personal data.",
            "Some websites sue for scraping under CFAA (in the US) — legal gray zones are risky.",
            "We scrape product data for market research — but only from public, non-login pages.",
            "Anonymizing tools (like proxies) help avoid IP bans but don’t absolve ethical responsibility.",
            "Scrapers that overload small sites can cause downtime — always be respectful.",
            "We added exponential backoff and retry logic to mimic real users.",
            "Automating consent clicks is legally sketchy — we avoid scraping gated content entirely.",
            "Scraping for journalism is often protected, but depends on jurisdiction.",
            "Most lawsuits against scraping come from ignoring ToS — read them!",
            "Make sure to cache pages to avoid hitting servers too often.",
            "Our scraper checks for legal disclaimers on every site and logs them before continuing.",
            "Some companies embed honeypots to detect bots — parsing hidden links can get you blacklisted.",
            "Scraping real-time data like stock prices is heavily regulated — tread carefully.",
            "Instead of scraping HTML, we watch browser devtools to find XHR/JSON endpoints.",
            "To stay compliant, we audit our scraping tools quarterly for ethical concerns.",
            "Public data ≠ free-for-all — legality varies by country and use-case.",
            "Avoid scraping behind logins — authentication often implies extra terms.",
            "Our team uses a checklist: robots.txt, ToS, rate limit, data type, jurisdiction, legality.",
            "Web scraping helped us build a database of academic papers — all from open-access journals.",
            "You can get legally binding notices through scraping — we log all response headers for proof.",
            "If your scraper ignores robots.txt, courts may view it as circumvention.",
            "Using rotating residential proxies? You’re skirting ethics, if not legality.",
            "When scraping news articles, we attribute sources and only use excerpts.",
            "We contribute to archive.org instead of hoarding data in private silos.",
            "Web scraping has a place in research, but scraping people’s profiles is too risky legally.",
            "We got flagged as a DDoS once — switched to crawl-delay logic to avoid it.",
            "The safest path? Ask permission first. Many sites will grant limited access.",
            "Our scraper has a delay between each page and logs everything for audit.",
            "We whitelist pages and domains, never general “scrape all links” behavior.",
            "Scraping publicly available court records can still be sensitive — we anonymize results.",
            "Web scraping: powerful, yes — but always ask, “Should we?” not just “Can we?”"
        ];

        // Get users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Weekly date range logic
        function weekRange(int $week): array
        {
            $start = now()->subWeeks(4 - $week)->startOfWeek();
            $end = $start->copy()->endOfWeek();
            return [$start, $end];
        }

        foreach ($posts as $index => $body) {
            $weekNumber = intdiv($index, 10) + 1;
            [$start, $end] = weekRange($weekNumber);
            $created = $faker->dateTimeBetween($start, $end);

            $visible = $index < 10; // First 10 are visible

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => 22, // Web Scraping Discussion ID
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $created,
                'updated_at'    => $created,
            ]);
        }

        $this->command->info("✅ Seeded 40 Web Scraping posts (10 visible) to discussion ID 22.");
    }
}
