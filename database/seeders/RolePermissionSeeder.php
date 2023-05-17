<?php

namespace Database\Seeders;

use App\Acl\Acl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (Acl::roles() as $role) {
            Role::findOrCreate($role);
        }

        foreach (Acl::permissions() as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdminRole = Role::findByName(Acl::ROLE_SUPER_ADMIN);
        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $staffRole = Role::findByName(Acl::ROLE_STAFF);
        $supplierRole = Role::findByName(Acl::ROLE_SUPPLIER);
        $customerRole = Role::findByName(Acl::ROLE_CUSTOMER);

        $superAdminRole->givePermissionTo(Acl::permissions());
        $adminRole->givePermissionTo(Acl::permissions([Acl::PERMISSION_PERMISSION_MANAGE]));
        $staffRole->givePermissionTo([
            Acl::PERMISSION_VIEW_MENU_STAFF,
            Acl::PERMISSION_VIEW_MENU_DASHBOARD,
            Acl::PERMISSION_USER_LIST,
        ]);

        $customerRole->givePermissionTo([
            Acl::PERMISSION_VIEW_MENU_DASHBOARD,

            Acl::PERMISSION_POST_MANAGE,
            Acl::PERMISSION_POST_LIST,
            Acl::PERMISSION_POST_ADD,
            Acl::PERMISSION_POST_EDIT,
            Acl::PERMISSION_POST_DELETE,

            Acl::PERMISSION_SCHEDULE_MANAGE,
            Acl::PERMISSION_SCHEDULE_LIST,
            Acl::PERMISSION_SCHEDULE_ADD,
            Acl::PERMISSION_SCHEDULE_EDIT,
            Acl::PERMISSION_SCHEDULE_DELETE,

            Acl::PERMISSION_SOCIAL_MEDIA_MANAGE,
            Acl::PERMISSION_SOCIAL_MEDIA_LIST,
            Acl::PERMISSION_SOCIAL_MEDIA_ADD,
            Acl::PERMISSION_SOCIAL_MEDIA_EDIT,
            Acl::PERMISSION_SOCIAL_MEDIA_DELETE,

            Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_MANAGE,
            Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_LIST,
            Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_ADD,
            Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_EDIT,
            Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_DELETE,

            Acl::PERMISSION_CHATGPT_MANAGE
        ]);
    }
}
