<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define roles
        $roles = [
            'admin',
            'moderator',
            'user',
        ];

        // Define permissions
        $permissions = [
            'auto-approve-posts',
            'auto-approve-discussions',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Assign permissions to roles
        Role::where('name', 'admin')->first()?->givePermissionTo($permissions);
        Role::where('name', 'moderator')->first()?->givePermissionTo($permissions);

        $this->command->info('✅ Roles and permissions seeded successfully!');
    }
}
