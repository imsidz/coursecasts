<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DartFlutterDiscussionsSeeder extends Seeder
{
    public function run(): void
    {
        $discussions = include database_path('data/dart_flutter_discussions.php');

        foreach ($discussions as $data) {
            DB::table('discussions')->updateOrInsert(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'topic_id' => $data['topic_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('✅ Dart/Flutter discussions seeded successfully.');
    }
}
