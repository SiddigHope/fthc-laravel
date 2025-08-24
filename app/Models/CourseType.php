<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'lookup_courses_type';
    protected $primaryKey = 'typId';
    public $timestamps = false;

    protected $fillable = [
        'typName_en',
        'typName_ar',
        'typStatus'
    ];

    protected $casts = [
        'typStatus' => 'boolean'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'typId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->typName_ar : $this->typName_en;
    }
}
