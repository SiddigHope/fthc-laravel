<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InPersonCourse extends Model
{
    protected $table = 'courses_inperson';
    protected $primaryKey = 'crsInId';

    protected $fillable = [
        'crsId',
        'crsInCreditHoursNumber',
        'crsInAccreditationNumber',
        'crsInLecturer',
        'crsInImageAr',
        'crsInImageEn',
        'crsInLocation',
        'lctDateStart',
        'lctDateEnd',
        'lctTimeStart',
        'lctTimeEnd',
        'lctStatus',
        'crsInSummaryEn',
        'crsInSummaryAr',
        'crsInDetailsAr',
        'crsInDetailsEn',
        'crsInTimeTableEn',
        'crsInTimeTableAr',
        'crsInAttachment'
    ];

    protected $casts = [
        'crsInLecturer' => 'array',
        'lctDateStart' => 'date',
        'lctDateEnd' => 'date',
        'lctTimeStart' => 'datetime',
        'lctTimeEnd' => 'datetime',
        'lctStatus' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'crsId');
    }

    public function getSummaryAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->crsInSummaryAr : $this->crsInSummaryEn;
    }

    public function getDetailsAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->crsInDetailsAr : $this->crsInDetailsEn;
    }

    public function getTimeTableAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->crsInTimeTableAr : $this->crsInTimeTableEn;
    }

    public function getImageAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->crsInImageAr : $this->crsInImageEn;
    }
}
