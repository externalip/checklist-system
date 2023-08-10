<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AuditSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AuditSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(ResponseFieldSeeder::class);
    }
}
