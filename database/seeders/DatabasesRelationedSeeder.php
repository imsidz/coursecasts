<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;

class DatabasesRelationedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update discussion title and visibility
        \DB::table('discussions')->where('id', 75)->update([
            'title' => 'MySQL vs. PostgreSQL: Which Relational Database Is Right for You?',
            'visible' => true,
        ]);

        $faker = Faker::create();

        $posts = [
            "PostgreSQL supports full ACID compliance and advanced features like window functions and CTEs.",
            "MySQL is easier to get started with, especially for beginners or simple web apps.",
            "We've found PostgreSQL to be more consistent with standards like ANSI SQL.",
            "If you're dealing with complex queries and analytics, PostgreSQL has the edge.",
            "MySQL works great for read-heavy workloads, especially with replication.",
            "PostgreSQL supports JSON and indexing JSON fields far better than MySQL.",
            "We had issues with MySQL's default settings around strict mode — be cautious.",
            "PostgreSQL has superior concurrency due to MVCC without read locks.",
            "In MySQL, certain subqueries can perform poorly without careful indexing.",
            "PostgreSQL offers rich data types like arrays, hstore, and even custom types.",
            "MySQL has better tooling in some hosting environments due to its long-time popularity.",
            "We migrated from MySQL to PostgreSQL and saw fewer issues with data integrity.",
            "If you’re building GIS features, PostgreSQL with PostGIS is unmatched.",
            "MySQL’s replication setup is simpler, but PostgreSQL’s logical replication is catching up.",
            "You can’t go wrong with either, but pick based on your application's complexity.",
            "PostgreSQL handles concurrent writes more predictably under heavy load.",
            "MySQL is faster at simple reads, but PostgreSQL wins at complex writes and updates.",
            "PostgreSQL has better support for stored procedures and server-side functions.",
            "For OLAP workloads, PostgreSQL integrates better with analytical tooling.",
            "We used PostgreSQL for financial data due to its transaction reliability.",
            "MySQL's default storage engine InnoDB has improved, but still lags behind PostgreSQL’s robustness.",
            "PostgreSQL has tighter enforcement of constraints and foreign keys.",
            "MySQL can silently truncate data unless strict mode is enabled — watch out!",
            "PostgreSQL’s community is very active and focused on stability and correctness.",
            "MySQL has made progress, but sometimes lags behind PostgreSQL in feature releases.",
            "PostgreSQL’s EXPLAIN and performance introspection tools are very powerful.",
            "For high write throughput, PostgreSQL performs better once tuned properly.",
            "MySQL’s ecosystem is wider for shared hosting, but cloud support is now equal.",
            "We use MySQL for WordPress sites and PostgreSQL for analytics and apps.",
            "PostgreSQL is better when you want to model complex relationships and constraints.",
            "JSONB in PostgreSQL gives NoSQL-like flexibility with SQL control.",
            "MySQL’s support for common table expressions (CTEs) came later and is still maturing.",
            "PostgreSQL has great support for extensions — we use PostGIS and pg_partman heavily.",
            "MySQL tends to be more forgiving — which can be good or bad depending on your needs.",
            "PostgreSQL’s vacuum process is confusing at first, but crucial for performance.",
            "We run benchmarks often — PostgreSQL consistently outperforms MySQL in mixed workloads.",
            "If you need horizontal scaling, both support it, but PostgreSQL options are more varied.",
            "PostgreSQL's WAL system is better suited for point-in-time recovery and backup strategies.",
            "When we moved to microservices, PostgreSQL’s schema management helped a lot.",
            "You can run both in parallel — just know where each one shines best."
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
                'discussion_id' => 75,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);
        }

        $this->command->info("✅ Seeded 40 MySQL vs PostgreSQL posts (10 visible) to discussion ID 75.");
    }
}
