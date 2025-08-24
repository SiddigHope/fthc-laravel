<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['rolId' => 1, 'rolNameEn' => 'Admin', 'rolNameAr' => 'مدير'],
            ['rolId' => 2, 'rolNameEn' => 'Lecturer', 'rolNameAr' => 'محاضر'],
            ['rolId' => 3, 'rolNameEn' => 'Trainee', 'rolNameAr' => 'متدرب'],
        ];

        DB::table('lookup_roles')->insert($roles);
    }
}
