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
        Schema::create('person_deputy_governor_media', function (Blueprint $table) {
            $table->comment('نشست های رسانه ای');
            $table->id('media_id')->autoIncrement();
            $table->string('media_president_id')->comment('رئیس جمهور')->index();
            $table->string('media_person_id')->comment('نام نماینده')->index();
            $table->string('media_gov_period_id')->comment('شماره دولت')->index();
            $table->string('media_parliament_period_id')->comment('شماره مجلس')->index();
            $table->string('media_start_date')->comment('تاریخ شروع نشست');
            $table->string('media_end_date')->comment('تاریخ پایان نشست');
            $table->string('media_province_id')->comment('استان مقصد');
            $table->longText('media_description')->comment('توضیحات');
            $table->string('media_subject')->comment('موضوع نشست');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_media');
    }
};
