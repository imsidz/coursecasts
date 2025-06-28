<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostsHandlingFormsReactSeeder extends Seeder
{
    public function run(): void
    {
        $posts = include database_path('data/updated_posts_handling_forms_react.php');

        foreach ($posts as $postData) {
            DB::table('posts')->insert([
                'discussion_id' => 708, // React Forms Discussion
                'user_id' => $postData['user_id'] ?? rand(1, 40),
                'body' => $postData['body'],
                'visible' => $postData['visible'] ?? true,
                'created_at' => Carbon::parse($postData['created_at']),
                'updated_at' => Carbon::parse($postData['updated_at']),
            ]);
        }

        $this->command->info('✅ Posts for "Handling Forms in React" discussion seeded successfully.');
    }
}
