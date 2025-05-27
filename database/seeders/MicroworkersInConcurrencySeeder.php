<?php

namespace Database\Seeders;

class MicroworkersInConcurrencySeeder extends BaseDiscussionSeeder
{
    protected function discussionId(): int
    {
        return 386;
    }

    protected function title(): string
    {
        return "What Are Microworkers in Concurrency?";
    }

    protected function topicId(): int
    {
        return 12;
    }

    protected function postFile(): string
    {
        return 'microworkers_in_concurrency_posts.php';
    }

    protected function tagNames(): array
    {
        return ['concurrency', 'microworkers', 'task-scheduling'];
    }
}
