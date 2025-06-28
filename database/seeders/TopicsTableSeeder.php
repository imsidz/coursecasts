<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
    {
        // Define groupings
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

        // Get group IDs
        $groups = DB::table('topic_groups')->pluck('id', 'name');

        foreach ($groupTopics as $groupName => $topicNames) {
            $groupId = $groups[$groupName] ?? null;

            if ($groupId) {
                foreach ($topicNames as $topicName) {
                    $topic = Topic::where('name', $topicName)->first();
                    if ($topic) {
                        DB::table('topic_group_topic')->updateOrInsert([
                            'topic_group_id' => $groupId,
                            'topic_id' => $topic->id,
                        ]);
                    }
                }
            }
        }

        $this->command->info("✅ Assigned topics to their respective groups.");
    }
}
