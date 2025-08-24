<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        DB::table('users')->insert([
            'usrId' => 1,
            'usrEmail' => 'admin@fthc.sa',
            'password' => Hash::make('password123'),
            'rolId' => 1, // Admin role
            'usrMobile' => '0581463433', // Admin role
            'usrStatus' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create admin profile
        DB::table('admins')->insert([
            'usrId' => 1,
            'adminNameAr' => "محمد احمد",
            'adminNameEn' => "Mohamed Ahmed",
            'adminMobile' => '0581463433', // Admin role
            'adminWhatsUp' => '0581463433', // Admin role
            'adminGander' => 1,
            'adminImage' => 'https://jerrysusa.com/wp-content/uploads/2014/11/doctor-profile-02.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
