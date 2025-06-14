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
        Schema::create('person_interpellations', function (Blueprint $table) {
            $table->comment('استیضاح');
            $table->integer('interpellation_id')->autoIncrement();
            $table->string('interpellation_president_id')->comment('رئیس جمهور');
            $table->string('interpellation_person_id')->comment('شخصی که از او استیضاح شده');
            $table->string('interpellation_gov_period_id')->comment('شماره دولت');
            $table->string('interpellation_parliament_period_id')->comment('شماره مجلس');
            $table->string('interpellation_meeting')->comment('اجلاسیه');
            $table->string('interpellation_register_number')->comment('شماره ثبت');
            $table->string('interpellation_axis')->comment('محور استیضاح:');
            $table->longText('interpellation_summary')->comment('چکیده استیضاح');
            $table->string('interpellation_worksheet_media_id')->comment('کاربرگ استیضاح');
            $table->string('interpellation_correspondence_worksheet_media_id')->comment('مکاتبات مجلس با دولت');
            $table->string('interpellation_commission_id')->comment('کمیسیون تخصصی');
            $table->string('interpellation_commission_meeting_date')->comment('تاریج جلسه کمیسیون');
            $table->string('interpellation_commission_result')->comment('نتیجه بررسی در کمیسیون');
            $table->string('interpellation_receipt_date')->comment('تاریخ اعلام وصول');
            $table->string('interpellation_public_court_date')->comment('تاریخ بررسی در صحن علنی');
            $table->string('interpellation_public_parliament_session_number')->comment('شماره جلسه صحن علنی');
            $table->string('interpellation_public_parliament_check_result')->comment('نتیجه بررسی در صحن علنی');
            $table->longText('interpellation_parliament_correspondence')->comment('مکاتبات مجلس و دولت در استیضاح');
            $table->string('interpellation_audience')->comment('مخاطب استیضاح');
            $table->string('interpellation_designer')->comment('نام نماینده طراح استیضاح');
            $table->longText('interpellation_action_summary')->comment('چکیده اقدامات دستگاه مخاطب');
            $table->longText('interpellation_contents_summary')->comment('چکیده مطالب استیضاح کنندگان');
            $table->longText('interpellation_president_contents_summary')->comment('چکیده مطالب رئیس جمهور');
            $table->longText('interpellation_supporters_contents_summary')->comment('چکیده مطالب موافقین استیضاح');
            $table->longText('interpellation_opponents_contents_summary')->comment('چکیده مطالب مخالفین استیضاح');
            $table->longText('interpellation_governors_opinion')->comment('نظر استانداران در رصد آراء نمایندگان');
            $table->longText('interpellation_governors_actions')->comment('اقدامات استانداران در رفع استیضاح');
            $table->longText('interpellation_deputies_actions')->comment('اقدامات معاونین امور مجلس در رفع استیضاح');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interpellations');
    }
};
