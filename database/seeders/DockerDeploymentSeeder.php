<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;

class DockerDeploymentSeeder extends Seeder
{
    public function run(): void
    {
        $discussionId = 173;

        \DB::table('discussions')->where('id', $discussionId)->update([
            'title' => 'how-docker-simplifies-application-deployment',
            'visible' => true,
        ]);

        $faker = Faker::create();
        $posts = $this->dockerDeploymentPosts();

        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        $baseDay = now()->subDays(rand(5, 10))->startOfDay();
        $currentTime = $baseDay->copy();

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
        $this->command->info("🕓 Only $allowedVisible post(s) set as visible (max 5 every 24h).");
    }

    private function dockerDeploymentPosts(): array
    {
        return [
            "Docker allows you to package your application with all its dependencies, ensuring consistency across environments.",
            "We use Docker to run the same stack on dev, staging, and production — no more 'works on my machine' issues.",
            "With Docker Compose, we define all services in one place — database, queue, app, and more.",
            "Docker simplifies CI/CD pipelines because containers are predictable and portable.",
            "You can test your entire app in isolation using Docker networks and volumes.",
            "Our team builds multi-architecture images so we can run the app on both ARM and x86 easily.",
            "Docker makes onboarding new developers easy — just clone the repo and run `docker-compose up`.",
            "We version control our Dockerfiles to track changes to the base system and runtime environment.",
            "Using Docker Hub or GitHub Container Registry, we ship container images globally in seconds.",
            "Our Kubernetes clusters pull prebuilt Docker images directly — it cuts deploy time massively.",
            "We use `docker-compose.override.yml` to customize environments locally without changing main config.",
            "For local testing, we spin up Redis, MySQL, and Mailhog in one command using Docker.",
            "Docker lets us test every PR in a clean container before it hits staging.",
            "We use Alpine-based images to keep our containers small and fast.",
            "Docker images give us reproducible builds — crucial for debugging production issues.",
            "We use `docker build --target` stages to separate dev and production builds.",
            "Docker makes it easier to test different versions of PHP, Node, and Python quickly.",
            "Running tests in Docker containers ensures our CI is environment-agnostic.",
            "Every microservice in our stack runs in its own container — scalable and maintainable.",
            "Our Dockerized app runs the same whether on AWS, DigitalOcean, or local laptop.",
            "We configure health checks inside containers to auto-restart failed services.",
            "Secrets are injected at runtime using Docker Compose `.env` files.",
            "Container logs are centralized to avoid debugging chaos across multiple VMs.",
            "Docker simplifies dependency management — no global installs needed.",
            "We isolate tools like PostgreSQL, Elasticsearch, and RabbitMQ with Docker for devs.",
            "Our Docker setup includes hot reload for Laravel, Node.js, and frontend tooling.",
            "By caching layers properly in Dockerfiles, we cut build time by 70%.",
            "We use Docker volumes to persist database state across rebuilds during development.",
            "Docker images let us freeze exact runtime versions of every tool our app depends on.",
            "We rollback deploys by just switching the running image tag in Kubernetes.",
            "Docker allowed us to migrate from a monolith to services without rewriting everything.",
            "The Docker daemon helps monitor and isolate containers with CPU/memory limits.",
            "Our base Docker image includes SSH, cron, and supervisor for full OS flexibility.",
            "We use multi-container tests to simulate entire user workflows including APIs and databases.",
            "Docker enables us to fork any GitHub repo and run it locally in seconds.",
            "For legacy apps, we use Docker to freeze environments and extend lifespan without retooling.",
            "Our frontend uses Vite and is built inside a Node Docker container on CI.",
            "Docker containers help us enforce security rules at the runtime level.",
            "We document every service with `README.docker.md` so devs can spin up systems instantly.",
            "Docker isn't magic, but it gave us speed, reproducibility, and confidence in shipping software.",
        ];
    }
}
