<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
                'first_name' => 'Dummy',
                'last_name' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'mobile' => '7384731240',
                'profile_picture' => 'profile_picture.jpg',
                'username' => 'dummy_admin',
                'status' => 'active',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
