<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lookup_countries', function (Blueprint $table) {
            $table->id('cntId');
            $table->string('cntAlpha2', 5)->nullable();
            $table->string('cntAlpha3', 5)->nullable();
            $table->string('cntNameAr', 100)->nullable();
            $table->string('cntNameEn', 100)->nullable();
            $table->string('cntCurNameAr', 100)->nullable();
            $table->string('cntCurNameEn', 100)->nullable();
            $table->string('cntCurCode', 5)->nullable();
            $table->boolean('cntCurDefault')->default(0);
            $table->boolean('cntDefault')->default(0);
            $table->boolean('cntStatus')->default(0);
            $table->boolean('cntCurStatus')->default(0);
            $table->string('cntLng', 10)->nullable();
            $table->string('cntDir', 10)->default('ltr');
            $table->integer('cntOrder')->default(100);
        });

        Schema::create('lookup_roles', function (Blueprint $table) {
            $table->id('rolId');
            $table->string('rolNameAr', 50);
            $table->string('rolNameEn', 50);
            $table->boolean('rolStatus')->default(1);
        });

        Schema::create('lookup_courses_type', function (Blueprint $table) {
            $table->id('typId');
            $table->string('typName_en', 25);
            $table->string('typName_ar', 25);
            $table->boolean('typStatus')->default(1);
        });

        Schema::create('lookup_specialization', function (Blueprint $table) {
            $table->id('spcId');
            $table->string('spcNameAr');
            $table->string('spcNameEn');
            $table->boolean('spcStatus')->default(1);
        });

        Schema::create('lookup_sub_specialization', function (Blueprint $table) {
            $table->id('spcSubId');
            $table->foreignId('spcId')
                  ->constrained('lookup_specialization', 'spcId')
                  ->cascadeOnDelete();
            $table->string('spcSubNameAr');
            $table->string('spcSubNameEn');
            $table->boolean('spcSubStatus')->default(1);
        });

        Schema::create('lookup_unclassified', function (Blueprint $table) {
            $table->id('unclassId');
            $table->string('unclassAr', 25);
            $table->string('unclassEn', 25);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lookup_unclassified');
        Schema::dropIfExists('lookup_sub_specialization');
        Schema::dropIfExists('lookup_specialization');
        Schema::dropIfExists('lookup_courses_type');
        Schema::dropIfExists('lookup_roles');
        Schema::dropIfExists('lookup_countries');
    }
};
