<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(40)->create();

        $this->call([
            // UsersTableSeeder::class,
            // PostsTableSeeder::class,
            RealisticPostsSeeder::class,
        ]);

        // if (!User::where('email', 'test@example.com')->first()) {
        //     User::factory()->create([
        //         'username' => 'Test User',
        //         'email' => 'test@example.com',
        //     ]);
        // }
        
        // Topic::firstOrCreate(
        //     ['slug' => 'php'], 
        //     ['title' => 'PHP'] 
        // );
        
        // Topic::firstOrCreate(
        //     ['slug' => 'javascript'],
        //     ['title' => 'Javascript']
        // );
        
        // Topic::firstOrCreate(
        //     ['slug' => 'css'],
        //     ['title' => 'CSS']
        // );
        
    }
}
