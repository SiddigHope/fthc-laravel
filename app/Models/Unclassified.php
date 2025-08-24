<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unclassified extends Model
{
    protected $table = 'lookup_unclassified';
    protected $primaryKey = 'unclassId';
    public $timestamps = false;

    protected $fillable = [
        'unclassAr',
        'unclassEn'
    ];

    public function trainees()
    {
        return $this->hasMany(Trainee::class, 'unclassId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->unclassAr : $this->unclassEn;
    }
}
