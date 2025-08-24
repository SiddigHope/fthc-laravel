<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'typId' => 1,
                'typName_en' => 'In-Person Training',
                'typName_ar' => 'تدريب حضوري',
                'typStatus' => 1,
            ],
            [
                'typId' => 2,
                'typName_en' => 'Online Training',
                'typName_ar' => 'تدريب عن بعد',
                'typStatus' => 1,
            ],
            [
                'typId' => 3,
                'typName_en' => 'Hybrid Training',
                'typName_ar' => 'تدريب مدمج',
                'typStatus' => 1,
            ],
        ];

        DB::table('lookup_courses_type')->insert($types);
    }
}
