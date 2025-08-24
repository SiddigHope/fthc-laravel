<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'usrId';

    protected $fillable = [
        'usrMobile',
        'usrEmail',
        'password',
        'rolId',
        'usrStatus'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'usrStatus' => 'boolean',
        'email_verified_at' => 'datetime'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'cntId');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'rolId');
    }

    public function traineeProfile()
    {
        return $this->hasOne(Trainee::class, 'usrId');
    }

    public function lecturerProfile()
    {
        return $this->hasOne(Lecturer::class, 'usrId');
    }

    public function adminProfile()
    {
        return $this->hasOne(Admin::class, 'usrId');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'usrId');
    }

    public function getNameAttribute()
    {
        if ($this->traineeProfile) {
            return app()->getLocale() == 'ar' ? $this->traineeProfile->trnNameAr : $this->traineeProfile->trnNameEn;
        }
        if ($this->lecturerProfile) {
            return app()->getLocale() == 'ar' ? $this->lecturerProfile->lctNameAr : $this->lecturerProfile->lctNameEn;
        }
        if ($this->adminProfile) {
            return app()->getLocale() == 'ar' ? $this->adminProfile->admnNameAr : $this->adminProfile->admnNameEn;
        }
        return $this->usrEmail;
    }

    public function isTrainee()
    {
        return $this->role && $this->role->rolNameEn === 'trainee';
    }

    public function isLecturer()
    {
        return $this->role && $this->role->rolNameEn === 'lecturer';
    }

    public function isAdmin()
    {
        return $this->role && $this->role->rolNameEn === 'admin';
    }

}
