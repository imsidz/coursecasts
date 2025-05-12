<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get 20 random user IDs
        $userIds = \App\Models\User::inRandomOrder()->limit(20)->pluck('id');

        foreach ($userIds as $userId) {
            Post::create([
                'user_id' => $userId,
                'discussion_id' => 1,
                'parent_id' => null,
                'body' => $faker->paragraphs(asText: true, nb: 5), // about 50+ words
            ]);
        }
    }
}
