<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLecturer extends Model
{
    protected $table = 'course_lecturers';
    protected $primaryKey = 'clId';

    protected $fillable = [
        'crsId',
        'usrId',
        'crsInId',
        'clRole',
        'clSchedule',
        'clNotes'
    ];

    protected $casts = [
        'clSchedule' => 'array'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'crsId');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'usrId');
    }

    public function inPersonCourse()
    {
        return $this->belongsTo(InPersonCourse::class, 'crsInId');
    }
}
