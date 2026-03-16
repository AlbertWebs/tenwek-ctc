<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        $superAdmin = Role::where('slug', 'super_admin')->first();
        $editor = Role::where('slug', 'editor')->first();

        User::firstOrCreate(
            ['email' => 'admin@tenwek-ctc.demo'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role_id' => $superAdmin->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@tenwek-ctc.demo'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
                'role_id' => $editor->id,
            ]
        );

        // Assign super_admin to the default Test User if it exists (for demo)
        $testUser = User::where('email', 'test@example.com')->first();
        if ($testUser && ! $testUser->role_id) {
            $testUser->update(['role_id' => $editor->id]);
        }
    }
}
