<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = 'lecturers';
    protected $primaryKey = 'usrId';

    protected $fillable = [
        'lctImage',
        'lctNameAr',
        'lctNameEn',
        'lctGander',
        'cntId',
        'lctMobile',
        'lctWhatsUp',
        'lctExperienceEn',
        'lctExperienceAr',
        'lctEducationAr',
        'lctEducationEn'
    ];

    protected $casts = [
        'lctGander' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usrId');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'cntId');
    }
}
