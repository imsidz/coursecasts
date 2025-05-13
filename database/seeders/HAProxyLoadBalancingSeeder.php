<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\User;

class HAProxyLoadBalancingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $posts = [
            "HAProxy makes it easy to distribute traffic to Docker containers — just point it to the container IPs.",
            "Using Docker Compose with HAProxy lets you scale services horizontally with minimal effort.",
            "I prefer HAProxy over NGINX for balancing because of its built-in health checks and performance.",
            "Be sure to map internal Docker ports to the HAProxy config, especially when using custom networks.",
            "Using DNS-based service discovery with Docker and HAProxy saved us from hardcoding container IPs.",
            "HAProxy's `server-template` directive pairs really well with Docker Swarm mode.",
            "Rate limiting in HAProxy is a hidden gem — useful when containers get overwhelmed.",
            "Logging HAProxy metrics into Prometheus helped us optimize scaling thresholds.",
            "Docker networks make container balancing seamless — HAProxy just needs access to the right bridge.",
            "HAProxy reloads config without downtime — crucial when updating container pools.",
            "Adding SSL termination in HAProxy simplified the container configs dramatically.",
            "Sticky sessions in HAProxy can be tricky with containers — use consistent hashing if needed.",
            "Load balancing WebSockets with HAProxy works, but make sure to enable `option http-server-close`.",
            "The stats interface in HAProxy is a lifesaver during debugging container issues.",
            "You can dynamically update HAProxy backend servers with tools like Consul or Docker events.",
            "I used to restart HAProxy manually — now I template the config and reload it with a container watch script.",
            "Be careful with Docker host IPs — use internal DNS names where possible.",
            "We run HAProxy in its own container — lightweight and portable.",
            "Connecting containers across hosts? You’ll need an overlay network like Docker Swarm or Calico.",
            "Health checks from HAProxy helped us identify a bad container build that kept crashing.",
            "Docker Compose + HAProxy + Let's Encrypt = one slick deployment stack.",
            "You can expose HAProxy on a public port and still keep all app containers private.",
            "Mapping each Docker container to a unique backend is fine for small setups — but templates scale better.",
            "Our latency dropped significantly after switching from round-robin to leastconn in HAProxy.",
            "We use labels in Docker Compose and a script to auto-generate HAProxy configs.",
            "HAProxy lets you do blue/green deployments easily by toggling backend weight.",
            "Balancing HTTPS traffic? Don’t forget to offload SSL in HAProxy or containers will struggle.",
            "With HAProxy and Docker, I can spin up staging environments in seconds.",
            "Logging HAProxy access logs to a file mounted from the host keeps things clean.",
            "A small mistake in HAProxy config can block all containers — use `haproxy -c -f` to test before reload!",
            "I use a local HAProxy + Docker combo for dev, and the same setup in prod — it's consistent.",
            "DNS resolution in HAProxy happens only once unless you use `resolvers` and `hold` settings.",
            "HAProxy with Docker Swarm is underrated — built-in service discovery is solid.",
            "Running HAProxy as a sidecar container gives us flexibility in Kubernetes-style setups.",
            "When scaling containers, we use tags to mark backends and route accordingly in HAProxy.",
            "Docker + HAProxy works great for microservices, especially with routing by path or subdomain.",
            "Don’t forget about timeouts — a common mistake in container load balancing.",
            "HAProxy’s zero-downtime reload feature helped us during traffic spikes.",
            "HAProxy helped reduce AWS load balancer costs by taking traffic internally first.",
            "I wish I knew earlier that `option redispatch` solves many container failover issues.",
            "No other proxy gives us HAProxy’s mix of raw power and fine-tuned config control.",
        ];

        // Ensure 40 users exist
        $userIds = User::inRandomOrder()->limit(count($posts))->pluck('id')->toArray();
        while (count($userIds) < count($posts)) {
            $userIds[] = User::inRandomOrder()->first()->id;
        }

        // Helper: get weekly date ranges
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
                'discussion_id' => 201, // HAProxy + Docker discussion
                'parent_id'     => null,
                'body'          => $body,
                'visible'       => $visible,
                'created_at'    => $created,
                'updated_at'    => $created,
            ]);
        }

        $this->command->info("✅ Seeded 40 HAProxy & Docker posts (10 visible) to discussion ID 201.");
    }
}
