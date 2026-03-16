<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Manage team', 'slug' => 'team.manage', 'group' => 'content'],
            ['name' => 'Manage services', 'slug' => 'services.manage', 'group' => 'content'],
            ['name' => 'Manage news', 'slug' => 'news.manage', 'group' => 'content'],
            ['name' => 'Manage users & roles', 'slug' => 'users.manage', 'group' => 'admin'],
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['slug' => $p['slug']], $p);
        }

        $superAdmin = Role::firstOrCreate(
            ['slug' => 'super_admin'],
            ['name' => 'Super Admin', 'description' => 'Full access to dashboard and user/role management']
        );
        $superAdmin->permissions()->sync(Permission::pluck('id'));

        $editor = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'description' => 'Can manage team, services, and news only']
        );
        $editor->permissions()->sync(
            Permission::whereIn('slug', ['team.manage', 'services.manage', 'news.manage'])->pluck('id')
        );
    }
}
