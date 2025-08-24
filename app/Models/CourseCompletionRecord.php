<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCompletionRecord extends Model
{
    protected $table = 'course_completion_records';
    protected $primaryKey = 'ccrId';

    protected $fillable = [
        'regId',
        'ccrType',
        'ccrScore',
        'ccrStatus',
        'ccrCompletedAt',
        'ccrNotes',
        'ccrMetadata'
    ];

    protected $casts = [
        'ccrScore' => 'decimal:2',
        'ccrCompletedAt' => 'datetime',
        'ccrMetadata' => 'array'
    ];

    public function registration()
    {
        return $this->belongsTo(CourseRegistration::class, 'regId');
    }
}
