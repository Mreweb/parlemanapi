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
        Schema::create('person_vote_confidence', function (Blueprint $table) {
            $table->comment('رای اعتماد');
            $table->id('vote_confidence_id')->autoIncrement();
            $table->string('vote_confidence_president_id')->comment('رئیس جمهور')->index("vc_pr_id");
            $table->string('vote_confidence_person_id')->comment('شخصی که از او استیضاح شده')->index("vc_p_id");
            $table->string('vote_confidence_gov_period_id')->comment('شماره دولت')->index("vc_g_per_id");
            $table->string('vote_confidence_parliament_period_id')->comment('شماره مجلس')->index("v_c_p_per_id");
            $table->string('vote_confidence_meeting')->comment('اجلاسیه');
            $table->string('vote_confidence_register_number')->comment('شماره ثبت');
            $table->string('vote_confidence_date')->comment('تاریج ثبت');
            $table->string('vote_confidence_commission_id')->comment('کمیسیون تخصصی');
            $table->string('vote_confidence_commission_meeting_date')->comment('تاریج جلسه کمیسیون');
            $table->longText('vote_confidence_commission_report')->comment('گزارش  کمیسیون در صحن');
            $table->string('vote_confidence_public_court_date')->comment('تاریخ بررسی در صحن علنی');
            $table->string('vote_confidence_public_parliament_session_number')->comment('شماره جلسه صحن علنی');
            $table->string('vote_confidence_public_parliament_check_result')->comment('نتیجه بررسی در صحن علنی');
            $table->string('vote_confidence_ministry_person_name')->comment('نام وزیر پیشنهادی');
            $table->string('vote_confidence_ministry_id')->comment('نام وزارتخانه');
            $table->longText('vote_confidence_action_summary')->comment('چکیده اقدامات دستگاه مخاطب');
            $table->longText('vote_confidence_president_contents_summary')->comment('چکیده مطالب رئیس جمهور');
            $table->longText('vote_confidence_contents_summary')->comment('چکیده مطالب وزیر مورد رای اعتماد');
            $table->longText('vote_confidence_supporters_summary')->comment('چکیده مطالب موافقین رای اعتماد');
            $table->longText('vote_confidence_opposing_summary')->comment('چکیده مطالب مخالفین رای اعتماد');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_confidence');
    }
};
