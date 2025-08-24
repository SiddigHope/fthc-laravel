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
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->id('usrId');
            $table->string('usrEmail')->unique();
            $table->string('usrMobile', 20);
            $table->string('password');
            $table->foreignId('rolId')->constrained('lookup_roles', 'rolId');
            $table->boolean('usrStatus')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // Admins
        Schema::create('admins', function (Blueprint $table) {
            $table->foreignId('usrId')->primary()->constrained('users', 'usrId')->onDelete('cascade');
            $table->string('adminImage')->nullable();
            $table->string('adminNameAr')->nullable();
            $table->string('adminNameEn')->nullable();
            $table->string('adminGander')->nullable();
            $table->string('adminMobile')->nullable();
            $table->string('adminWhatsUp')->nullable();
            $table->timestamps();
        });

        // Lecturers
        Schema::create('lecturers', function (Blueprint $table) {
            $table->foreignId('usrId')->primary()->constrained('users', 'usrId')->onDelete('cascade');
            $table->string('lctImage')->nullable();
            $table->string('lctNameAr')->nullable();
            $table->string('lctNameEn')->nullable();
            $table->integer('lctGander')->nullable();
            $table->foreignId('cntId')->constrained('lookup_countries', 'cntId');
            $table->string('lctMobile')->nullable();
            $table->string('lctWhatsUp')->nullable();
            $table->text('lctExperienceEn')->nullable();
            $table->text('lctExperienceAr')->nullable();
            $table->text('lctEducationEn')->nullable();
            $table->text('lctEducationAr')->nullable();
            $table->timestamps();
        });

        // Trainees
        Schema::create('trainees', function (Blueprint $table) {
            $table->foreignId('usrId')->primary()->constrained('users', 'usrId')->onDelete('cascade');
            $table->string('trnNameAr')->nullable();
            $table->string('trnNameEn')->nullable();
            $table->integer('trnGander')->nullable();
            $table->foreignId('cntId')->constrained('lookup_countries', 'cntId');
            $table->string('trnMobile')->nullable();
            $table->string('trnWhatsUp')->nullable();
            $table->boolean('isSCFHS')->nullable();
            $table->string('trnSCFHS')->nullable();
            $table->foreignId('spcId')->nullable()->constrained('lookup_specialization', 'spcId');
            $table->foreignId('spcSubId')->nullable()->constrained('lookup_sub_specialization', 'spcSubId');
            $table->foreignId('unclassId')->nullable()->constrained('lookup_unclassified', 'unclassId');
            $table->timestamps();
        });

        // Courses
        Schema::create('courses', function (Blueprint $table) {
            $table->id('crsId');
            $table->string('crsNameEn');
            $table->string('crsNameAr');
            $table->string('crsImage')->nullable();
            $table->foreignId('typId')->constrained('lookup_courses_type', 'typId');
            $table->timestamp('crsDate');
            $table->foreignId('spcId')->constrained('lookup_specialization', 'spcId');
            $table->foreignId('spcSubId')->constrained('lookup_sub_specialization', 'spcSubId');
            $table->decimal('crsPrice', 10, 2);
            $table->text('crsDescriptionEn')->nullable();
            $table->text('crsDescriptionAr')->nullable();
            $table->boolean('crsStatus')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // In-Person Courses
        Schema::create('courses_inperson', function (Blueprint $table) {
            $table->id('crsInId');
            $table->foreignId('crsId')->constrained('courses', 'crsId')->onDelete('cascade');
            $table->integer('crsInCreditHoursNumber')->nullable();
            $table->string('crsInAccreditationNumber')->nullable();
            $table->json('crsInLecturer');
            $table->string('crsInImageAr')->nullable();
            $table->string('crsInImageEn')->nullable();
            $table->string('crsInLocation');
            $table->date('lctDateStart');
            $table->date('lctDateEnd');
            $table->time('lctTimeStart');
            $table->time('lctTimeEnd');
            $table->tinyInteger('lctStatus')->default(1);
            $table->text('crsInSummaryEn');
            $table->text('crsInSummaryAr');
            $table->text('crsInDetailsAr');
            $table->text('crsInDetailsEn');
            $table->text('crsInTimeTableEn')->nullable();
            $table->text('crsInTimeTableAr')->nullable();
            $table->string('crsInAttachment')->nullable();
            $table->timestamps();
        });

        // Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invId');
            $table->string('invIdNum')->unique();
            $table->foreignId('invUser')->constrained('users', 'usrId');
            $table->string('invType', 20);
            $table->tinyInteger('invStatus')->default(1);
            $table->text('invNote')->nullable();
            $table->decimal('invTotalPrice', 10, 2);
            $table->decimal('invDiscount', 10, 2)->default(0);
            $table->decimal('invFinalPrice', 10, 2);
            $table->string('invPayMethod', 50)->nullable();
            $table->timestamp('invDate');
            $table->foreignId('invCreatedBy')->constrained('users', 'usrId');
            $table->string('invPaymentId')->nullable();
            $table->string('invInvoiceId')->nullable();
            $table->string('invPaymentMethodId')->nullable();
            $table->string('invRcvName');
            $table->string('invRcvEmail');
            $table->string('invRcvMobile', 20);
            $table->tinyInteger('invPaymentStatus')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Invoice Items
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id('invItemId');
            $table->foreignId('invId')->constrained('invoices', 'invId')->onDelete('cascade');
            $table->foreignId('crsId')->constrained('courses', 'crsId');
            $table->integer('invItemQty')->default(1);
            $table->decimal('invItemPrice', 10, 2);
            $table->decimal('invItemDiscount', 10, 2)->default(0);
            $table->decimal('invItemTotal', 10, 2);
            $table->text('invItemNote')->nullable();
            $table->tinyInteger('invItemType')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('courses_inperson');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('trainees');
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');
    }
};
