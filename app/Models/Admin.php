<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'users_profile_admin';
    protected $primaryKey = 'usrId';

    protected $fillable = [
        'admnImage',
        'admnNameAr',
        'admnNameEn',
        'admnGander',
        'admnMobile',
        'admnWhatsUp'
    ];

    protected $casts = [
        'admnGander' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usrId');
    }
}
