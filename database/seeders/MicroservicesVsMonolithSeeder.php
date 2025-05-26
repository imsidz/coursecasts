<?php

namespace Database\Seeders;

class MicroservicesVsMonolithSeeder extends BaseDiscussionSeeder
{
    protected function discussionId(): int
    {
        return 304;
    }

    protected function title(): string
    {
        return 'Microservices vs. Monolithic: Which One Is Right for Your Application?';
    }

    protected function topicId(): int
    {
        return 10;
    }

    protected function postFile(): string
    {
        return 'microservices_vs_monolith_posts.php';
    }

    protected function tagNames(): array
    {
        return ['microservices', 'monolithic'];
    }
}
