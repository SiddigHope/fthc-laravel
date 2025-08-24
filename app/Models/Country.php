<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'lookup_countries';
    protected $primaryKey = 'cntId';
    public $timestamps = false;

    protected $fillable = [
        'cntAlpha2',
        'cntAlpha3',
        'cntNameAr',
        'cntNameEn',
        'cntCurNameAr',
        'cntCurNameEn',
        'cntCurCode',
        'cntCurDefault',
        'cntDefault',
        'cntStatus',
        'cntCurStatus',
        'cntLng',
        'cntDir',
        'cntOrder'
    ];

    protected $casts = [
        'cntCurDefault' => 'boolean',
        'cntDefault' => 'boolean',
        'cntStatus' => 'boolean',
        'cntCurStatus' => 'boolean',
    ];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->cntNameAr : $this->cntNameEn;
    }
}
