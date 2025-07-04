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
        Schema::create('person_deputy_governor_meeting', function (Blueprint $table) {
            $table->comment('دیدار با معاونین مجمع استانی');
            $table->id('meeting_id')->autoIncrement();
            $table->string('meeting_president_id')->comment('رئیس جمهور')->index('mprid');
            $table->string('meeting_person_id')->comment('نام نماینده')->index('mpid');
            $table->string('meeting_gov_period_id')->comment('شماره دولت')->index('mpgid');
            $table->string('meeting_parliament_period_id')->comment('شماره مجلس')->index('mppid');
            $table->string('meeting_start_date')->comment('تاریخ شروع دیدار');
            $table->string('meeting_end_date')->comment('تاریخ پایان دیدار');
            $table->string('meeting_province_id')->comment('استان مقصد');
            $table->longText('meeting_description')->comment('توضیحات');
            $table->string('meeting_subject')->comment('موضوع دیدار');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_meeting');
    }
};
