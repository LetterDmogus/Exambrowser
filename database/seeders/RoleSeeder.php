<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create superadmin role
        $role = Role::firstOrCreate(['name' => 'superadmin']);

        // Assign to the test user created in DatabaseSeeder
        $user = User::where('username', 'testuser')->first();
        if ($user) {
            $user->assignRole($role);
        }
    }
}
