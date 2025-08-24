<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSpecialization extends Model
{
    protected $table = 'lookup_sub_specialization';
    protected $primaryKey = 'spcSubId';
    public $timestamps = false;

    protected $fillable = [
        'spcId',
        'spcSubNameAr',
        'spcSubNameEn',
        'spcSubStatus'
    ];

    protected $casts = [
        'spcSubStatus' => 'boolean'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spcId');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'spcSubId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->spcSubNameAr : $this->spcSubNameEn;
    }
}
