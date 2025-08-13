<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdditionalUsersSeeder extends Seeder
{
    public function run(): void
    {
        $existingCount = User::count();
        $targetCount = 280; // 80 existing + 200 new

        $usersToAdd = max(0, $targetCount - $existingCount);

        if ($usersToAdd > 0) {
            User::factory($usersToAdd)->create();
        }
    }
}
