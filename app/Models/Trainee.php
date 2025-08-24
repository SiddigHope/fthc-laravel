<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $table = 'trainees';
    protected $primaryKey = 'usrId';

    protected $fillable = [
        'usrId',
        'trnNameAr',
        'trnNameEn',
        'trnGander',
        'cntId',
        'trnMobile',
        'trnWhatsUp',
        'isSCFHS',
        'trnSCFHS',
        'spcId',
        'spcSubId',
        'unclassId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usrId');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'cntId');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spcId');
    }

    public function subSpecialization()
    {
        return $this->belongsTo(SubSpecialization::class, 'spcSubId');
    }

    public function unclassified()
    {
        return $this->belongsTo(Unclassified::class, 'unclassId');
    }
}
