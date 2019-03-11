<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $admin               = Role::create(['name' => config('access.users.admin_role')]);
        $executive           = Role::create(['name' => 'executive']);
        $user                = Role::create(['name' => config('access.users.default_role')]);
        $service_of_security = Role::create(['name' => 'service_of_security']);
        $pass_bureau         = Role::create(['name' => 'pass_bureau']);

        // Create Permissions
        $permissions = ['view backend', 'service of security', 'pass bureau'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo(Permission::all());

        // Assign Permissions to other Roles
        $executive->givePermissionTo('view backend');
        $service_of_security->givePermissionTo(['service of security', 'view backend']);
        $pass_bureau->givePermissionTo(['pass bureau', 'view backend']);

        $this->enableForeignKeys();
    }
}
