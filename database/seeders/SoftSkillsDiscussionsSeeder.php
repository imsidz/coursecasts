<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Discussion;

class SoftSkillsDiscussionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🌱 Seeding soft skills discussions...');

        $data = include database_path('data/soft_skills_discussions.php');
        $topicId = 19; // Make sure this topic ID exists
        $userIdRange = range(25, 65);

        foreach ($data as $item) {
            $userId = $userIdRange[array_rand($userIdRange)];

            Discussion::create([
                'user_id' => $userId,
                'topic_id' => $topicId,
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'visible' => true,
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
            ]);
        }

        $this->command->info('✅ Soft skills discussions seeded successfully.');
    }
}
