<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'cntId' => 1,
                'cntAlpha2' => null,
                'cntAlpha3' => null,
                'cntNameAr' => 'أكروتيري ودهكيليا',
                'cntNameEn' => 'Akrotiri and Dhekelia',
                'cntCurNameAr' => 'يورو',
                'cntCurNameEn' => 'Euro',
                'cntCurCode' => 'EUR',
                'cntCurDefault' => 0,
                'cntDefault' => 0,
                'cntStatus' => 0,
                'cntCurStatus' => 0,
                'cntLng' => 'en',
                'cntDir' => 'ltr',
                'cntOrder' => 100,
            ],
            [
                'cntId' => 2,
                'cntAlpha2' => null,
                'cntAlpha3' => null,
                'cntNameAr' => 'أرض الصومال',
                'cntNameEn' => 'Somaliland',
                'cntCurNameAr' => 'شيلينغ صومالي',
                'cntCurNameEn' => 'Somaliland Shilling',
                'cntCurCode' => 'SOS',
                'cntCurDefault' => 0,
                'cntDefault' => 0,
                'cntStatus' => 0,
                'cntCurStatus' => 0,
                'cntLng' => 'en',
                'cntDir' => 'ltr',
                'cntOrder' => 100,
            ],
        ];

        DB::table('lookup_countries')->insert($countries);
    }
}
