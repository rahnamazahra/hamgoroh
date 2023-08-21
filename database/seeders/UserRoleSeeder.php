<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user1 = User::create([
            'first_name'    => 'محمدحجت',
            'last_name'     => 'اسماعیل بیگی',
            'phone'         => '09128512934',
            'password'      => '$2y$10$VPWWn1FmvVUh7YW4MAnHq.FBHtyGlX7uvMVgWhpvwNzwyGWkWxiTW',
            'is_active'     => 1,
            'province_id'   => 19,
            'city_id'       => 722,
            'national_code' => '1111111111',
            'gender'        => 1,
            'birthday_date' => '1994-07-04',
        ]);

        $user2 = User::create([
            'first_name'    => 'علی',
            'last_name'     => 'سمیعی',
            'phone'         => '09197453829',
            'password'      => '$2y$10$VPWWn1FmvVUh7YW4MAnHq.FBHtyGlX7uvMVgWhpvwNzwyGWkWxiTW',
            'is_active'     => 1,
            'province_id'   => 19,
            'city_id'       => 722,
            'national_code' => '1111111112',
            'gender'        => 1,
            'birthday_date' => '1992-03-24',
        ]);

        $user3 = User::create([
            'first_name'    => 'ریحانه',
            'last_name'     => 'پناهی',
            'phone'         => '09198709687',
            'password'      => '$2y$10$VPWWn1FmvVUh7YW4MAnHq.FBHtyGlX7uvMVgWhpvwNzwyGWkWxiTW',
            'is_active'     => 1,
            'province_id'   => 19,
            'city_id'       => 722,
            'national_code' => '1111111113',
            'gender'        => 0,
            'birthday_date' => '1998-08-03',
        ]);

        $user4 = User::create([
            'first_name'    => 'زهرا',
            'last_name'     => 'رهنما',
            'phone'         => '09306756076',
            'password'      => '$2y$10$VPWWn1FmvVUh7YW4MAnHq.FBHtyGlX7uvMVgWhpvwNzwyGWkWxiTW',
            'is_active'     => 1,
            'province_id'   => 19,
            'city_id'       => 722,
            'national_code' => '1111111114',
            'gender'        => 0,
            'birthday_date' => '1990-12-31',
        ]);

        $user5 = User::create([
            'first_name'    => 'فاطمه',
            'last_name'     => 'طوسی',
            'phone'         => '09912531490',
            'password'      => '$2y$10$VPWWn1FmvVUh7YW4MAnHq.FBHtyGlX7uvMVgWhpvwNzwyGWkWxiTW',
            'is_active'     => 1,
            'province_id'   => 19,
            'city_id'       => 722,
            'national_code' => '1111111414',
            'gender'        => 0,
            'birthday_date' => '1990-12-31',
        ]);

        $developer          = Role::create(['title' => 'برنامه نویس', 'slug' => 'developer', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $admin              = Role::create(['title' => 'ادمین', 'slug' => 'admin', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $general_manager    = Role::create(['title' => 'مدیرکل', 'slug' => 'general_manager', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $provincial_manager = Role::create(['title' => 'مدیراستانی', 'slug' => 'provincial_manager', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $referee            = Role::create(['title' => 'داور', 'slug' => 'referee', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $teacher            = Role::create(['title' => 'استاد', 'slug' => 'teacher', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        $user               = Role::create(['title' => 'کاربر', 'slug' => 'user', 'is_orginal' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        $user1->roles()->attach($admin->id);
        $user2->roles()->attach($admin->id);
        $user3->roles()->attach([$developer->id, $admin->id]);
        $user4->roles()->attach([$developer->id, $admin->id]);
        $user5->roles()->attach([$developer->id, $admin->id]);
    }
}
