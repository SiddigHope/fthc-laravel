<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'crsId';

    protected $fillable = [
        'crsNameEn',
        'crsNameAr',
        'crsImage',
        'typId',
        'crsDate',
        'spcId',
        'spcSubId',
        'crsPrice',
        'crsStatus',
        'crsDescriptionEn',
        'crsDescriptionAr'
    ];

    protected $casts = [
        'crsDate' => 'datetime',
        'crsPrice' => 'decimal:2',
        'crsStatus' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'typId');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spcId');
    }

    public function subSpecialization()
    {
        return $this->belongsTo(SubSpecialization::class, 'spcSubId');
    }

    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class, 'crsId');
    }

    public function inPersonDetails()
    {
        return $this->hasOne(InPersonCourse::class, 'crsId');
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'crsId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->crsNameAr : $this->crsNameEn;
    }
}
