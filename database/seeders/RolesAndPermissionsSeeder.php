<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $allPermissions = [
            'categories' => ['view-category', 'create-category', 'edit-category', 'delete-category'],
            'products' => ['view-product', 'create-product', 'edit-product', 'delete-product'],
            'orders' => ['view-order', 'create-order', 'edit-order', 'delete-order'],
            'users' => ['view-user', 'delete-user'],
            'dashboard' => ['view-dashboard'],
            'checkout' => ['view-checkout'],
            'cart' => ['view-cart'],
        ];

        foreach ($allPermissions as $permissions) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        // create roles and assign existing permissions
        $roles = [
            'admin' => [
                'categories' => ['view-category', 'create-category', 'edit-category', 'delete-category'],
                'products' => ['view-product', 'edit-product', 'delete-product'],
                'orders' => ['view-order', 'delete-order'],
                'users' => ['view-user', 'delete-user'],
                'dashboard' => ['view-dashboard'],
            ],
            'farmer' => [
                'products' => ['view-product', 'create-product', 'edit-product', 'delete-product'],
                'orders' => ['view-order'],
                'dashboard' => ['view-dashboard'],
            ],
            'customer' => [
                'checkout' => ['view-checkout'],
                'cart' => ['view-cart'],
                'dashboard' => ['view-dashboard'],
                'orders' => ['view-order'],
            ],
        ];

        foreach ($roles as $role => $permissions) {
            $role = \Spatie\Permission\Models\Role::create(['name' => $role]);

            foreach ($permissions as $resource => $actions) {
                $role->givePermissionTo($actions);
            }
        }
    }
}
