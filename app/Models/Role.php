<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'lookup_roles';
    protected $primaryKey = 'rolId';
    public $timestamps = false;

    protected $fillable = [
        'rolNameAr',
        'rolNameEn',
        'rolStatus'
    ];

    protected $casts = [
        'rolStatus' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'rolId');
    }

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->rolNameAr : $this->rolNameEn;
    }
}
