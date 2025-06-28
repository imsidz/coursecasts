<?php

namespace Database\Seeders;

use App\Models\Discussion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OtherMobileFrameworksDiscussionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('📱 Seeding discussions for Other Mobile Frameworks...');

        $discussions = include database_path('data/mobile_discussions_data.php');

        foreach ($discussions as $data) {
            Discussion::create([
                'user_id' => $data['user_id'],
                'topic_id' => $data['topic_id'],
                'title' => $data['title'],
                'slug' => $data['slug'] ?? Str::slug($data['title']),
                'visible' => true,
                'created_at' => Carbon::parse($data['created_at']),
                'updated_at' => Carbon::parse($data['updated_at']),
            ]);
        }

        $this->command->info('✅ Other Mobile Framework discussions seeded successfully.');
    }
}
