<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Discussion;

class FrontendDiscussionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Seeding frontend discussions...');

        $discussions = include database_path('data/frontend_discussions_data.php');

        $userId = 1; // Adjust as needed
        $topicId = 18; // Frontend topic ID

        foreach ($discussions as $data) {
            $createdAt = isset($data['created_at']) ? Carbon::parse($data['created_at']) : now();
            $updatedAt = isset($data['updated_at']) ? Carbon::parse($data['updated_at']) : $createdAt;

            $discussion = Discussion::create([
                'user_id' => $userId,
                'topic_id' => $topicId,
                'title' => $data['title'],
                'slug' => $data['slug'] ?? Str::slug($data['title']),
                'visible' => true,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }

        $this->command->info('✅ Frontend discussions seeded successfully.');
    }
}
