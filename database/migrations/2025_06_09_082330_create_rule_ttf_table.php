<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_rule_ttf', function (Blueprint $table) {
            $table->comment('ماده 234');
            $table->integer('rule_ttf_id')->autoIncrement();
            $table->string('rule_ttf_president_id')->comment('رئیس جمهور');
            $table->string('rule_ttf_person_id')->comment('نام نماینده متقاضی ماده 234');
            $table->string('rule_ttf_gov_period_id')->comment('شماره دولت');
            $table->string('rule_ttf_parliament_period_id')->comment('شماره مجلس');
            $table->string('rule_ttf_meeting')->comment('اجلاسیه');
            $table->string('rule_ttf_register_number')->comment('شماره ثبت');
            $table->string('rule_ttf_subject')->comment('شماره ثبت');
            $table->string('rule_ttf_summary')->comment('شماره ثبت');
            $table->string('rule_ttf_worksheet_id')->comment('شماره ثبت');
            $table->string('rule_ttf_commission_id')->comment('شماره ثبت');
            $table->string('rule_ttf_commission_result')->comment('شماره ثبت');
            $table->string('rule_ttf_public_court_date')->comment('تاریخ بررسی در صحن علنی');
            $table->string('rule_ttf_public_parliament_session_number')->comment('شماره جلسه صحن علنی');
            $table->string('rule_ttf_public_parliament_check_result')->comment('نتیجه بررسی در صحن علنی');
            $table->string('rule_ttf_ministry_id')->comment('دستگاه ذیربط');
            $table->longText('rule_ttf_summary_content')->comment('چکیده اقدامات دستگاه مخاطب');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_ttf');
    }
};
