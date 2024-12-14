<?php

namespace Database\Seeders\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // premissions
        $permissions = [
            'all_users',
            'create_user',
            'edit_user',
            'update_user',
            'delete_user',
            'change_user_status',

            'all_roles',
            'create_role',
            'edit_role',
            'update_role',
            'delete_role',

            'all_customers',
            'create_customer',
            'edit_customer',
            'update_customer',
            'delete_customer',

            'all_events',
            'create_event',
            'edit_event',
            'update_event',
            'delete_event',
            'change_event_status',

            'all_blog_categories',
            'create_blog_category',
            'edit_blog_category',
            'update_blog_category',
            'delete_blog_category',

            'all_blogs',
            'create_blog',
            'edit_blog',
            'update_blog',
            'delete_blog',
            'change_blog_status',

            'all_faqs',
            'create_faq',
            'edit_faq',
            'update_faq',
            'delete_faq',

            'all_product_categories',
            'create_product_category',
            'edit_product_category',
            'update_product_category',
            'delete_product_category',

            'all_products',
            'create_product',
            'edit_product',
            'update_product',
            'delete_product',
            'change_product_status',

        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission], [
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }

        // roles
        $superAdmin = Role::create(['name' => 'superAdmin']);
        $superAdmin->givePermissionTo(Permission::all());


    }
}
