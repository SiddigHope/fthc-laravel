<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'lookup_specialization';
    protected $primaryKey = 'spcId';
    public $timestamps = false;

    protected $fillable = [
        'spcNameAr',
        'spcNameEn',
        'spcStatus'
    ];

    protected $casts = [
        'spcStatus' => 'boolean'
    ];

    public function subSpecializations()
    {
        return $this->hasMany(SubSpecialization::class, 'spcId');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'spcId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->spcNameAr : $this->spcNameEn;
    }
}
