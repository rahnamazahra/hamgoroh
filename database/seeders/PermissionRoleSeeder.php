<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $developer          = Role::find(1)->id;
        $admin              = Role::find(2)->id;
        $general_manager    = Role::find(3)->id;
        $provincial_manager = Role::find(4)->id;
        $referee            = Role::find(5)->id;
        $teacher            = Role::find(6)->id;

        $permission_admin_index = Permission::create([
            'title'       => 'داشبورد',
            'slug'        => 'admin-index',
            'description' => 'امکان مشاهده داشبورد',
        ]);

        $permission_roles_index = Permission::create([
            'title'       => 'لیست نقش‌ها',
            'slug'        => 'roles-index',
            'description' => 'امکان مشاهده لسیت نقش‌ها',
        ]);

        $permission_roles_create = Permission::create([
            'title'       => 'ایجاد نقش جدید',
            'slug'        => 'roles-create',
            'description' => 'امکان ایجاد نقش جدید',
        ]);

        $permission_roles_update = Permission::create([
            'title'       => 'ویرایش نقش',
            'slug'        => 'roles-update',
            'description' => 'امکان ویرایش نقش',
        ]);

        $permission_roles_delete = Permission::create([
            'title'       => 'حذف نقش',
            'slug'        => 'roles-delete',
            'description' => 'امکان حذف نقش',
        ]);

        $permission_permissions_index = Permission::create([
            'title'       => 'لیست دسترسی‌ها',
            'slug'        => 'permissions-index',
            'description' => 'امکان مشاهده لسیت دسترسی‌ها',
        ]);

        $permission_permissions_create = Permission::create([
            'title'       => 'ایجاد دسترسی جدید',
            'slug'        => 'permissions-create',
            'description' => 'امکان ایجاد دسترسی جدید',
        ]);

        $permission_permissions_update = Permission::create([
            'title'       => 'ویرایش دسترسی',
            'slug'        => 'permissions-update',
            'description' => 'امکان ویرایش دسترسی',
        ]);

        $permission_permissions_delete = Permission::create([
            'title'       => 'حذف دسترسی',
            'slug'        => 'permissions-delete',
            'description' => 'امکان حذف دسترسی',
        ]);

        $permission_users_index = Permission::create([
            'title'       => 'لیست کاربران',
            'slug'        => 'users-index',
            'description' => 'امکان مشاهده لسیت کاربران',
        ]);

        $permission_users_create = Permission::create([
            'title'       => 'ایجاد کاربر جدید',
            'slug'        => 'users-create',
            'description' => 'امکان ایجاد کاربر جدید',
        ]);

        $permission_users_update = Permission::create([
            'title'       => 'ویرایش کاربر',
            'slug'        => 'users-update',
            'description' => 'امکان ویرایش کاربر',
        ]);

        $permission_users_delete = Permission::create([
            'title'       => 'حذف کاربر',
            'slug'        => 'users-delete',
            'description' => 'امکان حذف کاربر',
        ]);
        $permission_users_meta_create = Permission::create([
            'title'       => 'ایجاد اطلاعات تکمیلی کاربر',
            'slug'        => 'users-meta-create',
            'description' =>  'امکان ایجاد اطلاعات تکمیلی کاربر',
        ]);
        $permission_users_meta_update = Permission::create([
            'title'       => 'ویرایش اطلاعات تکمیلی کاربر',
            'slug'        => 'users-meta-update',
            'description' =>  'امکان ویرایش اطلاعات تکمیلی کاربر',
        ]);
        $permission_users_meta_delete = Permission::create([
            'title'       => 'حذف اطلاعات تکمیلی کاربر',
            'slug'        => 'users-meta-delete',
            'description' =>  'امکان حذف اطلاعات تکمیلی کاربر',
        ]);
        $permission_provinces_index = Permission::create([
            'title'       => 'لیست اسـتان ها',
            'slug'        => 'provinces-index',
            'description' => 'امکان مشاهده لسیت اسـتان ها',
        ]);

        $permission_provinces_create = Permission::create([
            'title'       => 'ایجاد اسـتان  جدید',
            'slug'        => 'provinces-create',
            'description' => 'امکان ایجاد اسـتان  جدید',
        ]);

        $permission_provinces_update = Permission::create([
            'title'       => 'ویرایش اسـتان',
            'slug'        => 'provinces-update',
            'description' => 'امکان ویرایش اسـتان',
        ]);

        $permission_provinces_delete = Permission::create([
            'title'       => 'حذف اسـتان',
            'slug'        => 'provinces-delete',
            'description' => 'امکان حذف اسـتان',
        ]);

        $permission_cities_index = Permission::create([
            'title'       => 'لیست شـهر ها',
            'slug'        => 'cities-index',
            'description' => 'امکان مشاهده لسیت شـهر ها',
        ]);

        $permission_cities_create = Permission::create([
            'title'       => 'ایجاد شـهر  جدید',
            'slug'        => 'cities-create',
            'description' => 'امکان ایجاد شـهر  جدید',
        ]);

        $permission_cities_update = Permission::create([
            'title'       => 'ویرایش شـهر',
            'slug'        => 'cities-update',
            'description' => 'امکان ویرایش شـهر',
        ]);

        $permission_cities_delete = Permission::create([
            'title'       => 'حذف شـهر',
            'slug'        => 'cities-delete',
            'description' => 'امکان حذف شـهر',
        ]);

        $permission_fields_index = Permission::create([
            'title'       => 'لیست رشته ها',
            'slug'        => 'fields-index',
            'description' => 'امکان مشاهده لسیت رشته ها',
        ]);

        $permission_fields_create = Permission::create([
            'title'       => 'ایجاد رشته  جدید',
            'slug'        => 'fields-create',
            'description' => 'امکان ایجاد رشته  جدید',
        ]);

        $permission_fields_update = Permission::create([
            'title'       => 'ویرایش رشته',
            'slug'        => 'fields-update',
            'description' => 'امکان ویرایش رشته',
        ]);

        $permission_fields_delete = Permission::create([
            'title'       => 'حذف رشته',
            'slug'        => 'fields-delete',
            'description' => 'امکان حذف رشته',
        ]);

        $permission_competitions_index = Permission::create([
            'title'       => 'لیست رشته ها',
            'slug'        => 'competitions-index',
            'description' => 'امکان مشاهده لسیت رشته ها',
        ]);

        $permission_competitions_create = Permission::create([
            'title'       => 'ایجاد رشته  جدید',
            'slug'        => 'competitions-create',
            'description' => 'امکان ایجاد رشته  جدید',
        ]);

        $permission_competitions_update = Permission::create([
            'title'       => 'ویرایش رشته',
            'slug'        => 'competitions-update',
            'description' => 'امکان ویرایش رشته',
        ]);

        $permission_competitions_delete = Permission::create([
            'title'       => 'حذف رشته',
            'slug'        => 'competitions-delete',
            'description' => 'امکان حذف رشته',
        ]);

        $permission_groups_index = Permission::create([
            'title'       => 'لیست گروه ها',
            'slug'        => 'groups-index',
            'description' => 'امکان مشاهده لسیت گروه ها',
        ]);

        $permission_groups_create = Permission::create([
            'title'       => 'ایجاد گروه  جدید',
            'slug'        => 'groups-create',
            'description' => 'امکان ایجاد گروه  جدید',
        ]);

        $permission_groups_update = Permission::create([
            'title'       => 'ویرایش گروه',
            'slug'        => 'groups-update',
            'description' => 'امکان ویرایش گروه',
        ]);

        $permission_groups_delete = Permission::create([
            'title'       => 'حذف گروه',
            'slug'        => 'groups-delete',
            'description' => 'امکان حذف گروه',
        ]);

        $permission_evaluation_models_index = Permission::create([
            'title'       => 'لیست مدل‌های ارزیابی',
            'slug'        => 'evaluation-models-index',
            'description' => 'امکان مشاهده مدل‌های ارزیابی',
        ]);

        $permission_news_index = Permission::create([
            'title'       => 'لیست اخبار',
            'slug'        => 'news-index',
            'description' => 'امکان مشاهده لسیت اخبار',
        ]);

        $permission_news_create = Permission::create([
            'title'       => 'ایجاد خبر  جدید',
            'slug'        => 'news-create',
            'description' => 'امکان ایجاد خبر  جدید',
        ]);

        $permission_news_update = Permission::create([
            'title'       => 'ویرایش خبر',
            'slug'        => 'news-update',
            'description' => 'امکان ویرایش خبر',
        ]);

        $permission_news_delete = Permission::create([
            'title'       => 'حذف خبر',
            'slug'        => 'news-delete',
            'description' => 'امکان حذف خبر',
        ]);

        $permission_admin_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_roles_index->roles()->attach([$developer, $admin]);
        $permission_roles_create->roles()->attach([$developer, $admin]);
        $permission_roles_update->roles()->attach([$developer, $admin]);
        $permission_roles_delete->roles()->attach([$developer, $admin]);
        $permission_permissions_index->roles()->attach([$developer, $admin]);
        $permission_permissions_create->roles()->attach([$developer, $admin]);
        $permission_permissions_update->roles()->attach([$developer, $admin]);
        $permission_permissions_delete->roles()->attach([$developer, $admin]);
        $permission_users_meta_create->roles()->attach([$developer, $admin]);
        $permission_users_meta_update->roles()->attach([$developer, $admin]);
        $permission_users_meta_delete->roles()->attach([$developer, $admin]);
        $permission_users_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_users_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_users_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_users_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_provinces_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_provinces_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_provinces_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_provinces_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_cities_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_cities_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_cities_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_cities_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_fields_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_fields_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_fields_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_fields_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_competitions_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_competitions_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_competitions_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_competitions_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_groups_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_groups_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_groups_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_groups_delete->roles()->attach([$developer, $admin, $general_manager]);
        $permission_evaluation_models_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_news_index->roles()->attach([$developer, $admin, $general_manager]);
        $permission_news_create->roles()->attach([$developer, $admin, $general_manager]);
        $permission_news_update->roles()->attach([$developer, $admin, $general_manager]);
        $permission_news_delete->roles()->attach([$developer, $admin, $general_manager]);
    }
}
