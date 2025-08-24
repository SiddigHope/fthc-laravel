<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lecturers')->insert([
            [
                'usrId' => 2, // must exist in users_account
                'lctImage' => 'images/lecturers/ahmed.png',
                'lctNameAr' => 'د. أحمد السبيعي',
                'lctNameEn' => 'Dr. Ahmed Al-Subaie',
                'lctGander' => 1,
                'cntId' => 1, // Saudi Arabia from lookup_countries
                'lctMobile' => '0501234567',
                'lctWhatsUp' => '0501234567',
                'lctExperienceEn' => '10 years in emergency medicine and critical care.',
                'lctExperienceAr' => '10 سنوات في طب الطوارئ والعناية المركزة.',
                'lctEducationEn' => 'MBBS, Fellowship in Emergency Medicine',
                'lctEducationAr' => 'بكالوريوس طب وجراحة، زمالة طب الطوارئ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'usrId' => 3,
                'lctImage' => 'images/lecturers/fatima.png',
                'lctNameAr' => 'د. فاطمة القحطاني',
                'lctNameEn' => 'Dr. Fatima Al-Qahtani',
                'lctGander' => 0,
                'cntId' => 1,
                'lctMobile' => '0559876543',
                'lctWhatsUp' => '0559876543',
                'lctExperienceEn' => '8 years as pediatric consultant.',
                'lctExperienceAr' => '8 سنوات كاستشاري طب الأطفال.',
                'lctEducationEn' => 'MD Pediatrics, Pediatric Critical Care Diploma',
                'lctEducationAr' => 'دكتوراه في طب الأطفال، دبلوم العناية الحرجة للأطفال',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'usrId' => 4,
                'lctImage' => 'images/lecturers/salem.png',
                'lctNameAr' => 'د. سالم العنزي',
                'lctNameEn' => 'Dr. Salem Al-Anzi',
                'lctGander' => 1,
                'cntId' => 2, // Example another country
                'lctMobile' => '0561122334',
                'lctWhatsUp' => '0561122334',
                'lctExperienceEn' => '15 years of teaching cardiology.',
                'lctExperienceAr' => '15 سنة من تدريس أمراض القلب.',
                'lctEducationEn' => 'PhD in Cardiology, Fellow of American Heart Association',
                'lctEducationAr' => 'دكتوراه في أمراض القلب، زميل الجمعية الأمريكية للقلب',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'usrId' => 5,
                'lctImage' => 'images/lecturers/mona.png',
                'lctNameAr' => 'د. منى العتيبي',
                'lctNameEn' => 'Dr. Mona Al-Otaibi',
                'lctGander' => 0,
                'cntId' => 1,
                'lctMobile' => '0533344556',
                'lctWhatsUp' => '0533344556',
                'lctExperienceEn' => 'Expert in nursing education and training.',
                'lctExperienceAr' => 'خبيرة في تعليم وتدريب التمريض.',
                'lctEducationEn' => 'PhD in Nursing, MSc in Healthcare Education',
                'lctEducationAr' => 'دكتوراه في التمريض، ماجستير في التعليم الصحي',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'usrId' => 6,
                'lctImage' => 'images/lecturers/omar.png',
                'lctNameAr' => 'د. عمر الغامدي',
                'lctNameEn' => 'Dr. Omar Al-Ghamdi',
                'lctGander' => 1,
                'cntId' => 1,
                'lctMobile' => '0592233445',
                'lctWhatsUp' => '0592233445',
                'lctExperienceEn' => 'Specialist in pharmacology with 12 years of practice.',
                'lctExperienceAr' => 'متخصص في علم الأدوية مع 12 سنة خبرة عملية.',
                'lctEducationEn' => 'PhD in Pharmacology',
                'lctEducationAr' => 'دكتوراه في علم الأدوية',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
