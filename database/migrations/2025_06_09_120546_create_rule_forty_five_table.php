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
        Schema::create('rule_forty_five', function (Blueprint $table) {
            $table->integer('rule_forty_five_id')->autoIncrement();
            $table->string('president_id')->comment('رئیس جمهور');
            $table->string('person_id')->comment('نام نماینده متقاضی ماده 45');
            $table->string('gov_period_id')->comment('شماره دولت');
            $table->string('five_parliament_period_id')->comment('شماره مجلس');
            $table->string('rule_forty_five_meeting')->comment('اجلاسیه');
            $table->string('rule_forty_five_register_number')->comment('شماره ثبت');
            $table->string('rule_forty_five_subject')->comment('شماره ثبت');
            $table->string('rule_forty_five_summary')->comment('شماره ثبت');
            $table->string('rule_forty_five_worksheet_id')->comment('شماره ثبت');
            $table->string('rule_forty_five_commission_id')->comment('شماره ثبت');
            $table->string('rule_forty_five_commission_result')->comment('شماره ثبت');
            $table->string('rule_forty_five_public_court_date')->comment('تاریخ بررسی در صحن علنی');
            $table->string('rule_forty_five_public_parliament_session_number')->comment('شماره جلسه صحن علنی');
            $table->string('rule_forty_five_public_parliament_check_result')->comment('نتیجه بررسی در صحن علنی');
            $table->string('rule_forty_five_ministry_id')->comment('دستگاه ذیربط');
            $table->longText('rule_forty_five_summary_content')->comment('چکیده اقدامات دستگاه مخاطب');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_forty_five');
    }
};
