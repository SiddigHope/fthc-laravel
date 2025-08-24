<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseRegistration extends Model
{
    use SoftDeletes;

    protected $table = 'course_registrations';
    protected $primaryKey = 'regId';

    protected $fillable = [
        'usrId',
        'crsId',
        'crsInId',
        'invId',
        'regStatus',
        'regPaymentStatus',
        'regAmount',
        'regDiscount',
        'regFinalAmount',
        'regPaidAmount',
        'regStartDate',
        'regCompletedDate',
        'regProgress',
        'regAttendance',
        'regCertificateNo',
        'regCertificateIssueDate',
        'regNotes',
        'regCreatedBy'
    ];

    protected $casts = [
        'regAmount' => 'decimal:2',
        'regDiscount' => 'decimal:2',
        'regFinalAmount' => 'decimal:2',
        'regPaidAmount' => 'decimal:2',
        'regProgress' => 'decimal:2',
        'regStartDate' => 'datetime',
        'regCompletedDate' => 'datetime',
        'regCertificateIssueDate' => 'datetime',
        'regAttendance' => 'array'
    ];

    public function trainee()
    {
        return $this->belongsTo(User::class, 'usrId');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'crsId');
    }

    public function inPersonCourse()
    {
        return $this->belongsTo(InPersonCourse::class, 'crsInId');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invId');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'regCreatedBy');
    }

    public function completionRecords()
    {
        return $this->hasMany(CourseCompletionRecord::class, 'regId');
    }
}
