<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')-> truncate();

        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'superadmin'
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'admin'
        ]);
    }
}
