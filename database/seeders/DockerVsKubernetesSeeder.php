<?php

namespace Database\Seeders;

class DockerVsKubernetesSeeder extends ContainerOrchestrationSeeder
{
    protected int $discussionId = 450;
    protected string $title = 'Docker Swarm vs. Kubernetes: Which One Should You Choose?';
    protected array $tagNames = ['docker swarm', 'kubernetes'];
    protected string $postFile = 'docker_vs_kubernetes_posts.php';
}
