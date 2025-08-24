<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            [
                'spcId' => 1,
                'spcNameEn' => 'Medical',
                'spcNameAr' => 'طبي',
            ],
            [
                'spcId' => 2,
                'spcNameEn' => 'Nursing',
                'spcNameAr' => 'تمريض',
            ],
            [
                'spcId' => 3,
                'spcNameEn' => 'Allied Health',
                'spcNameAr' => 'صحة مساعدة',
            ],
        ];

        DB::table('lookup_specialization')->insert($specializations);

        $subSpecializations = [
            [
                'spcSubId' => 1,
                'spcId' => 1,
                'spcSubNameEn' => 'Internal Medicine',
                'spcSubNameAr' => 'طب باطني',
            ],
            [
                'spcSubId' => 2,
                'spcId' => 1,
                'spcSubNameEn' => 'Surgery',
                'spcSubNameAr' => 'جراحة',
            ],
            [
                'spcSubId' => 3,
                'spcId' => 2,
                'spcSubNameEn' => 'Critical Care Nursing',
                'spcSubNameAr' => 'تمريض العناية المركزة',
            ],
        ];

        DB::table('lookup_sub_specialization')->insert($subSpecializations);
    }
}
