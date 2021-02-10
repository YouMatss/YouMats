<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            'users',
            'vendors',
            'categories',
            'subCategories',
            'products',
            'languages',
            'faqs',
            'orders',
            'quotes',
            'countries',
            'cities',
            'contacts',
            'subscribers',
            'tags',
            'currencies',
            'memberships',
            'pages'
        ]);

        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            Permission::create(['name' => 'viewAny ' . $item]);
            Permission::create(['name' => 'view ' . $item]);
            Permission::create(['name' => 'create ' . $item]);
            Permission::create(['name' => 'update ' . $item]);
            Permission::create(['name' => 'delete ' . $item]);
            Permission::create(['name' => 'restore ' . $item]);
            Permission::create(['name' => 'forceDelete ' . $item]);
        });

        // Create a Super-Admin Role and assign all Permissions
        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        // Give User Super-Admin Role
        $admin = Admin::whereEmail('superAdmin@youmats.com')->first();
        $admin->assignRole('Super Admin');
    }
}
