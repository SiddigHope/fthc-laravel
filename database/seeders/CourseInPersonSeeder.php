<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseInPersonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses_inperson')->insert([
            [
                'crsInId' => 1,
                'crsId' => 1, // Basic Life Support
                'crsInCreditHoursNumber' => 8,
                'crsInAccreditationNumber' => 101,
                'crsInLecturer' => json_encode([1, 4]), // IDs of lecturers
                'crsInImageAr' => 'images/courses/bls_ar.png',
                'crsInImageEn' => 'images/courses/bls_en.png',
                'crsInLocation' => 'Riyadh - Training Center A',
                'lctDateStart' => Carbon::now()->addDays(5)->toDateString(),
                'lctDateEnd' => Carbon::now()->addDays(6)->toDateString(),
                'lctTimeStart' => '09:00:00',
                'lctTimeEnd' => '17:00:00',
                'lctStatus' => 1,
                'crsInSummaryEn' => 'Hands-on Basic Life Support skills training.',
                'crsInSummaryAr' => 'تدريب عملي على مهارات الإنعاش القلبي الأساسي.',
                'crsInDetailsAr' => 'تفاصيل شاملة عن الدورة، تشمل التنفس الصناعي والتدريب العملي.',
                'crsInDetailsEn' => 'Comprehensive details including CPR, airway management, and practice.',
                'crsInTimeTableEn' => 'Day 1: CPR basics, Day 2: Advanced drills',
                'crsInTimeTableAr' => 'اليوم الأول: أساسيات الإنعاش، اليوم الثاني: التدريبات المتقدمة',
                'crsInAttachment' => 'docs/bls_manual.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'crsInId' => 2,
                'crsId' => 2, // Advanced Cardiac Life Support
                'crsInCreditHoursNumber' => 16,
                'crsInAccreditationNumber' => 202,
                'crsInLecturer' => json_encode([3]),
                'crsInImageAr' => 'images/courses/acls_ar.png',
                'crsInImageEn' => 'images/courses/acls_en.png',
                'crsInLocation' => 'Jeddah - Hospital Conference Hall',
                'lctDateStart' => Carbon::now()->addDays(15)->toDateString(),
                'lctDateEnd' => Carbon::now()->addDays(16)->toDateString(),
                'lctTimeStart' => '10:00:00',
                'lctTimeEnd' => '18:00:00',
                'lctStatus' => 1,
                'crsInSummaryEn' => 'Advanced protocols for managing cardiac emergencies.',
                'crsInSummaryAr' => 'بروتوكولات متقدمة للتعامل مع الطوارئ القلبية.',
                'crsInDetailsAr' => 'دورة مكثفة تشمل استخدام الأدوية والتعامل مع الأزمات.',
                'crsInDetailsEn' => 'Intensive course covering medications and crisis response.',
                'crsInTimeTableEn' => 'Day 1: ECG, Day 2: Cardiac Arrest Management',
                'crsInTimeTableAr' => 'اليوم الأول: تخطيط القلب، اليوم الثاني: التعامل مع السكتة القلبية',
                'crsInAttachment' => 'docs/acls_guide.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'crsInId' => 3,
                'crsId' => 3, // Pediatric Advanced Life Support
                'crsInCreditHoursNumber' => 12,
                'crsInAccreditationNumber' => 303,
                'crsInLecturer' => json_encode([4, 2]),
                'crsInImageAr' => 'images/courses/pals_ar.png',
                'crsInImageEn' => 'images/courses/pals_en.png',
                'crsInLocation' => 'Dammam - Medical Training Institute',
                'lctDateStart' => Carbon::now()->addDays(25)->toDateString(),
                'lctDateEnd' => Carbon::now()->addDays(26)->toDateString(),
                'lctTimeStart' => '08:30:00',
                'lctTimeEnd' => '16:30:00',
                'lctStatus' => 1,
                'crsInSummaryEn' => 'Specialized pediatric emergency training.',
                'crsInSummaryAr' => 'تدريب متخصص في طوارئ الأطفال.',
                'crsInDetailsAr' => 'تعليم مهارات إنعاش وإنقاذ حياة الأطفال والرضع.',
                'crsInDetailsEn' => 'Covers pediatric CPR, airway, and pharmacology.',
                'crsInTimeTableEn' => 'Day 1: Pediatric CPR, Day 2: Emergency Drugs',
                'crsInTimeTableAr' => 'اليوم الأول: إنعاش الأطفال، اليوم الثاني: الأدوية الطارئة',
                'crsInAttachment' => 'docs/pals_notes.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
