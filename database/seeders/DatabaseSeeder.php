<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProvinceCitySeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(PermissionRoleSeeder::class);
    }
}
