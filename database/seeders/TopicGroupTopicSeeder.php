<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicGroupsTableSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            'Distributed Systems',
            'APIs & Integration',
            'Software Architecture',
            'Data Processing',
            'Big Data',
            'Machine Learning & Big Data',
            'Performance Optimization',
            'Security & Compliance',
            'Concurrency',
            'Container Management',
            'Databases',
            'Mobile Development',
            'Programming',
            'Search Technology',
        ];

        foreach ($groups as $group) {
            DB::table('topic_groups')->updateOrInsert([
                'name' => $group
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ Inserted topic groups.');
    }
}
