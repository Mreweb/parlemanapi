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
        Schema::create('person_deputy_governor_session', function (Blueprint $table) {
            $table->comment('جلسات با معاونین پارلمان');
            $table->id('session_id')->autoIncrement();
            $table->string('session_president_id')->comment('رئیس جمهور')->index('sprid');
            $table->string('session_person_id')->comment('نام نماینده')->index('spid');
            $table->string('session_gov_period_id')->comment('شماره دولت')->index('pgpid');
            $table->string('session_parliament_period_id')->comment('شماره مجلس')->index('sppid');
            $table->string('session_start_date')->comment('تاریخ شروع جلسات');
            $table->string('session_end_date')->comment('تاریخ پایان جلسات');
            $table->string('session_province_id')->comment('استان مقصد');
            $table->longText('session_description')->comment('توضیحات');
            $table->string('session_subject')->comment('موضوع جلسات');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_session');
    }
};
