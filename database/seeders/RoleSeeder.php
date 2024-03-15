<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define data for roles table
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'status' => 'active',
                'description' => 'Super Administrator Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'status' => 'active',
                'description' => 'Administrator Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Teacher',
                'slug' => 'teacher',
                'status' => 'active',
                'description' => 'Teacher Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Principal',
                'slug' => 'principal',
                'status' => 'active',
                'description' => 'Principal Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Student',
                'slug' => 'student',
                'status' => 'active',
                'description' => 'Student Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Guest',
                'slug' => 'guest',
                'status' => 'active',
                'description' => 'Guest Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert data into the roles table
        DB::table('roles')->insert($roles);
    }
}
