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
        Schema::create('person_rule_forty_five', function (Blueprint $table) {
            $table->comment('ماده 45');
            $table->id('rule_forty_five_id')->autoIncrement();
            $table->string('rule_forty_five_president_id')->comment('رئیس جمهور')->index("f_pr_id");
            $table->string('rule_forty_five_person_id')->comment('نام نماینده متقاضی ماده 45')->index("f_pr_person_id");
            $table->string('rule_forty_five_gov_period_id')->comment('شماره دولت')->index("f_pr_gov_period_id");
            $table->string('rule_forty_five_parliament_period_id')->comment('شماره مجلس')->index("f_pr_parliament_period_id");
            $table->string('rule_forty_five_meeting')->comment('اجلاسیه');
            $table->string('rule_forty_five_register_number')->comment('شماره ثبت');
            $table->string('rule_forty_five_subject')->comment('موضوع درخواست');
            $table->longText('rule_forty_five_summary')->comment('چکیده موضوع');
            $table->string('rule_forty_five_worksheet_id')->comment('کاربرگ');
            $table->string('rule_forty_five_commission_id')->comment('کمیسیون تخصصی');
            $table->string('rule_forty_five_commission_result')->comment('نتیجه بررسی در کمیسیون');
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
