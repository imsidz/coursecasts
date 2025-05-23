<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;

class APISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update discussion title and visibility
        \DB::table('discussions')->where('id', 135)->update([
            'title' => 'RESTful APIs: Resource Naming Conventions and URL Structure',
            'visible' => true,
        ]);

        $faker = Faker::create();

        $posts = [
            "Always use plural nouns for resource names in RESTful APIs, like `/users` or `/posts`.",
            "Avoid verbs in endpoint paths — the HTTP method already defines the action.",
            "Use kebab-case or snake_case in URLs consistently, e.g. `/user-profile` or `/user_profile`.",
            "Hierarchical routes like `/users/42/posts` imply a nested relationship.",
            "Avoid deeply nested resources; keep URLs readable and flat when possible.",
            "Use query parameters for filters and sorting — not path segments.",
            "Never use action names in the URL — use proper HTTP methods instead.",
            "Keep URL paths lowercase for consistency and SEO-friendliness.",
            "Use versioning in the API via URI (e.g., `/v1/users`) or headers.",
            "Return consistent and meaningful HTTP status codes for all endpoints.",
            "A `GET /users` call should always return a list — not a single resource.",
            "Avoid trailing slashes in URLs unless absolutely necessary.",
            "Use nouns to name collections and singular nouns for individual resources.",
            "Design endpoints so clients can guess URLs with ease.",
            "Represent relationships via sub-resources or linked URIs.",
            "Use 404s for not found, 403s for forbidden, and 422 for validation errors.",
            "Avoid exposing internal database IDs directly in URLs if possible.",
            "Use UUIDs if your app requires non-sequential, secure resource IDs.",
            "Provide clear, consistent error messages in JSON format.",
            "Document every endpoint with examples of expected input and output.",
            "Allow clients to paginate long collections via `?page=` and `?limit=`.",
            "Don’t overload a single route with too many optional behaviors.",
            "Use `PATCH` for partial updates, not `PUT`.",
            "Cache `GET` responses where safe and avoid caching mutable ones.",
            "Design with HATEOAS in mind — include links to related actions or resources.",
            "Resource names should describe *what*, not *how*.",
            "Use `/login` or `/auth` only for authentication flows, not regular resources.",
            "Don't expose sensitive internal logic via URLs (e.g., `/deleteAll`).",
            "Use middleware to enforce access controls per route.",
            "Use rate limiting for public API endpoints.",
            "Group routes by resource type, not controller or method name.",
            "Don't mix unrelated resources in a single endpoint.",
            "If an action doesn't map cleanly to REST, consider a `/commands` route.",
            "Avoid version numbers in file names — stick to the API versioning layer.",
            "Prefer predictable, reusable patterns in all endpoint naming.",
            "Use plural resource names consistently across all services.",
            "Enable CORS properly if your API serves external clients.",
            "Always return timestamps in ISO 8601 format.",
            "Provide IDs and self-links in all resource responses.",
            "Expose resource metadata in headers or top-level objects when useful."
        ];

        // Assign users
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Pick a base day for timestamps
        $baseDay = now()->subDays(rand(5, 10))->startOfDay();
        $currentTime = $baseDay->copy();

        foreach ($posts as $index => $body) {
            $currentTime->addHours(rand(2, 3));

            $visible = $index < 5; // Only first 5 posts are visible

            Post::create([
                'user_id'       => $userIds[$index],
                'discussion_id' => 135,
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $currentTime->copy(),
                'updated_at'    => $currentTime->copy(),
            ]);
        }

        $this->command->info("✅ Seeded 40 RESTful API posts (5 visible) to discussion ID 135.");
    }
}
