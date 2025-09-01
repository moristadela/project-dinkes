<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class RolesAndPermissionsSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Reset cached roles and permissions
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define Permissions
        // Admin permissions
        // Permission::firstOrCreate(['name' => 'view dashboard']);
        // Permission::firstOrCreate(['name' => 'view microsite']);
        // Permission::firstOrCreate(['name' => 'manage bidang']);
        // Permission::firstOrCreate(['name' => 'manage user']);

        // // 2. Define Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // // 3. Assign Permissions to Roles
        // // Admin gets all permissions
        // $adminRole->givePermissionTo(Permission::all());

        // User gets only specific permissions
        // $userRole->givePermissionTo([
        //     'view dashboard',
        //     'view microsite',
        // ]);

        $admin = User::where('name',operator: 'Administrator')->first();
        $admin->assignRole('admin');

        

    }
}
