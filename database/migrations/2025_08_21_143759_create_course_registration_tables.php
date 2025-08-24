<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id('regId');
            $table->foreignId('usrId')->constrained('users', 'usrId')->comment('The trainee who registered');
            $table->foreignId('crsId')->constrained('courses', 'crsId');
            $table->foreignId('crsInId')->nullable()->constrained('courses_inperson', 'crsInId');
            $table->foreignId('invId')->nullable()->constrained('invoices', 'invId')->comment('Related invoice if paid');
            $table->tinyInteger('regStatus')->default(1)->comment('1:Pending, 2:Confirmed, 3:Attending, 4:Completed, 5:Cancelled, 6:Refunded');
            $table->tinyInteger('regPaymentStatus')->default(0)->comment('0:Unpaid, 1:Paid, 2:Partial, 3:Refunded');
            $table->decimal('regAmount', 10, 2)->comment('Original course price at time of registration');
            $table->decimal('regDiscount', 10, 2)->default(0);
            $table->decimal('regFinalAmount', 10, 2)->comment('Final amount after discount');
            $table->decimal('regPaidAmount', 10, 2)->default(0)->comment('Amount actually paid');
            $table->timestamp('regStartDate')->nullable()->comment('When the trainee started the course');
            $table->timestamp('regCompletedDate')->nullable()->comment('When the trainee completed the course');
            $table->decimal('regProgress', 5, 2)->default(0)->comment('Course completion progress percentage');
            $table->json('regAttendance')->nullable()->comment('Attendance records for in-person courses');
            $table->string('regCertificateNo')->nullable()->comment('Certificate number after completion');
            $table->timestamp('regCertificateIssueDate')->nullable();
            $table->text('regNotes')->nullable();
            $table->foreignId('regCreatedBy')->constrained('users', 'usrId')->comment('Admin who created the registration');
            $table->timestamps();
            $table->softDeletes();

            // Compound unique to prevent duplicate registrations
            $table->unique(['usrId', 'crsId', 'deleted_at']);
        });

        // Pivot table for course lecturers assignment
        Schema::create('course_lecturers', function (Blueprint $table) {
            $table->id('clId');
            $table->foreignId('crsId')->constrained('courses', 'crsId');
            $table->foreignId('usrId')->constrained('users', 'usrId')->comment('Lecturer ID');
            $table->foreignId('crsInId')->nullable()->constrained('courses_inperson', 'crsInId');
            $table->tinyInteger('clRole')->default(1)->comment('1:Main Lecturer, 2:Assistant, 3:Guest');
            $table->json('clSchedule')->nullable()->comment('Lecturer schedule for the course');
            $table->text('clNotes')->nullable();
            $table->timestamps();

            // Compound unique to prevent duplicate assignments
            $table->unique(['crsId', 'usrId', 'crsInId']);
        });

        // Table for tracking course completion requirements
        Schema::create('course_completion_records', function (Blueprint $table) {
            $table->id('ccrId');
            $table->foreignId('regId')->constrained('course_registrations', 'regId');
            $table->string('ccrType')->comment('attendance, assignment, quiz, exam, etc.');
            $table->decimal('ccrScore', 5, 2)->nullable();
            $table->tinyInteger('ccrStatus')->default(0)->comment('0:Pending, 1:Completed, 2:Failed, 3:Exempted');
            $table->timestamp('ccrCompletedAt')->nullable();
            $table->text('ccrNotes')->nullable();
            $table->json('ccrMetadata')->nullable()->comment('Additional data based on requirement type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_completion_records');
        Schema::dropIfExists('course_lecturers');
        Schema::dropIfExists('course_registrations');
    }
};
