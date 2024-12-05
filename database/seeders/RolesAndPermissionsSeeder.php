<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'unpublish posts'
        ];


        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles and assign existing permissions
        if (!Role::where('name', 'writer')->exists()) {
            $writer = Role::create(['name' => 'writer']);
            $writer->givePermissionTo(['create posts', 'edit posts']);
        }

        if (!Role::where('name', 'moderator')->exists()) {
            $moderator = Role::create(['name' => 'moderator']);
            $moderator->givePermissionTo(['delete posts', 'publish posts', 'unpublish posts']);
        }

        if (!Role::where('name', 'super_admin')->exists()) {
            $superAdmin = Role::create(['name' => 'super_admin']);
            $superAdmin->givePermissionTo(Permission::all());
        }

        // Create dummy users and assign roles
        $user1 = User::firstOrCreate([
            'email' => 'writer@example.com'
        ], [
            'name' => 'Writer User',
            'password' => Hash::make('password')
        ]);

        $user2 = User::firstOrCreate([
            'email' => 'moderator@example.com'
        ], [
            'name' => 'Moderator User',
            'password' => Hash::make('password')
        ]);

        $user3 = User::firstOrCreate([
            'email' => 'superadmin@example.com'
        ], [
            'name' => 'Super Admin User',
            'password' => Hash::make('password')
        ]);

        $user1->assignRole('writer');
        $user2->assignRole('moderator');
        $user3->assignRole('super_admin');
    }

}
