<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class RealisticPostsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $posts = [
            "I remember when Excel was our main tool for data — now we're running Spark clusters!",
            "The shift from descriptive to predictive analytics completely changed how we plan.",
            "Big Data gave us the scale we needed — traditional databases just couldn’t keep up.",
            "ETL used to be a nightmare. Now with streaming pipelines, data's live in seconds.",
            "Cloud data warehouses like Snowflake are a game-changer over on-prem SQL servers.",
            "We used to rely on intuition — now everything is backed by hard metrics.",
            "Data dashboards used to lag behind — now execs see updates in real time.",
            "I still appreciate SQL, but tools like Apache Flink opened new doors.",
            "Data used to be siloed by department — now we have cross-functional data lakes.",
            "It’s wild how Hadoop paved the way, but newer tech like Delta Lake is taking over.",
            "Traditional analytics was about reports; Big Data is about action in the moment.",
            "Previously, we'd sample datasets. Now we analyze everything — every click, every log.",
            "With Big Data, marketing campaigns react instantly, not weeks later.",
            "The biggest change? From static monthly reports to live, streaming insights.",
            "Legacy BI tools were slow — now we're doing real-time anomaly detection.",
            "Machine learning wasn't even on the radar a decade ago — now it's everywhere.",
            "We’re no longer asking 'what happened?' but 'what will happen next?'",
            "The cost of storing data used to be a blocker — now it's affordable to collect everything.",
            "It's fascinating how open-source tools drove the Big Data revolution.",
            "Earlier we only had structured data — Big Data made unstructured analysis possible.",
            "The rise of APIs and event-driven architectures has transformed how we collect data.",
            "Before, reports were static PDFs. Now they’re live, interactive dashboards.",
            "Real-time fraud detection is only possible because of Big Data analytics.",
            "Our sales team used to guess — now they have lead-scoring powered by data.",
            "Traditional analytics was reactive; now we’re proactive thanks to real-time data.",
            "Back then, Excel crashed on large files. Now we're querying billions of rows.",
            "The role of the data analyst has evolved into data science and engineering roles.",
            "Data privacy has become even more crucial in the Big Data era.",
            "In the past, ‘more data’ meant ‘more delay’. Now it means better decisions.",
            "The evolution of storage — from local servers to scalable cloud object stores — is underrated.",
            "Big Data analytics made personalization scalable — from websites to emails.",
            "Legacy tools couldn’t handle streaming — now we process sensor data live.",
            "Even small teams can now run advanced analytics thanks to modern platforms.",
            "The shift from batch jobs to real-time analytics changed our whole architecture.",
            "We used to optimize after-the-fact. Now we do it as data comes in.",
            "Big Data brought a cultural shift — business leaders now think in data-first terms.",
            "I used to build reports manually. Now we build models that predict outcomes.",
            "We finally democratized data — dashboards are no longer IT-only territory.",
            "The analytics stack evolved from Excel + Access to dbt + Snowflake + Looker.",
            "Now we A/B test continuously — we didn’t even have those capabilities before.",
            "The most exciting part? We’re just getting started with real-time AI + analytics.",
        ];

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = $userIds[array_rand($userIds)];
        }

        // Helper to get a week's date range
        function weekRange(int $week): array
        {
            $start = now()->subWeeks(5 - $week)->startOfWeek(); // e.g., 4 weeks ago for week 1
            $end = $start->copy()->endOfWeek();
            return [$start, $end];
        }

        foreach ($posts as $index => $body) {
            $weekNumber = intdiv($index, 5) + 1; // 0–4 = Week 1, 5–9 = Week 2, etc.
            [$start, $end] = weekRange($weekNumber);
            $created = Faker::create()->dateTimeBetween($start, $end);

            $visible = $index < 5; // only first 5 posts (week 1) are visible

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => 2,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $created,
                'updated_at'    => $created,
            ]);
        }

        $this->command->info("✅ Seeded 20 posts over 4 weeks. 5 visible.");
    }
}