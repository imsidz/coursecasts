<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TopicGroup;
use App\Models\Topic;

class TopicGroupsAndAssignmentsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔧 Seeding topic groups...');

        $groupTopics = [
            'Distributed Systems' => ['Distributed Systems'],
            'APIs & Integration' => ['API'],
            'Software Architecture' => ['Architecture'],
            'Data Processing' => ['Batch Processing'],
            'Big Data' => ['Big Data'],
            'Machine Learning & Big Data' => ['Big Data and Machine Learning', 'Scalable Machine Learning for Big Data'],
            'Performance Optimization' => ['Big Data Performance Optimization'],
            'Security & Compliance' => ['Big Data Security'],
            'Concurrency' => ['Concurrency and Parallelism'],
            'Container Management' => ['Container Orchestration', 'Docker'],
            'Databases' => ['Databases'],
            'Mobile Development' => ['Mobile-empty'],
            'Programming' => ['Php', 'Python'],
            'Search Technology' => ['Search Engine'],
        ];

        // Create topic groups
        foreach (array_keys($groupTopics) as $groupName) {
            TopicGroup::firstOrCreate(['name' => $groupName]);
        }

        $this->command->info('🔗 Assigning topics to groups...');

        foreach ($groupTopics as $groupName => $topicNames) {
            $group = TopicGroup::where('name', $groupName)->first();

            if (!$group) {
                $this->command->warn("⚠️ Topic group '{$groupName}' not found.");
                continue;
            }

            foreach ($topicNames as $topicName) {
                $topic = Topic::where('title', $topicName)->first(); // ✅ use 'name' instead of 'title'

                if (!$topic) {
                    $this->command->warn("⚠️ Topic '{$topicName}' not found.");
                    continue;
                }

                $group->topics()->syncWithoutDetaching([$topic->id]);
            }
        }

        $this->command->info("✅ Topic groups and topic assignments seeded successfully.");
    }
}
