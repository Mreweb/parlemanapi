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
        Schema::create('person_notice', function (Blueprint $table) {
            $table->id('notice_id')->autoIncrement();
            $table->string('notice_person_id')->comment('شخصی که تذکر دهنده بوده')->nullable();
            $table->string('notice_president_id')->comment('در کدام شخص ریاست جمهوری تذکر داده شده')->nullable();
            $table->string('notice_gov_period_id')->comment('در کدام دوره دولت')->nullable();
            $table->string('notice_parliament_period_id')->comment('در کدام دوره مجلس')->nullable();
            $table->string('notice_meeting')->comment('اجلاسیه')->nullable();  //
            $table->string('notice_type')->comment('نوع تذکر')->nullable();
            $table->string('notice_reading_date')->comment('تاریخ قرائت')->nullable();
            $table->string('notice_register_number')->comment('شماره ثبت')->nullable();
            $table->string('notice_session_number')->comment('شماره جلسه علنی صحن مجلس')->nullable();
            $table->string('notice_subject')->comment('عنوان تذکر');
            $table->string('notice_summary')->comment('چکیده تذکر')->nullable();
            $table->string('notice_worksheet_media_id')->comment('کاربرگ تذکر')->nullable();
            $table->string('notice_to_person_id')->comment('مخاطب تذکر')->nullable();
            $table->string('notice_ministry_id')->comment('دستگاه تذکر')->nullable();
            $table->string('notice_designer_person_id')->comment('طراح تذکر')->nullable();
            $table->string('notice_designer_person_election_id')->comment('حوزه انتخابیه طراح تذکر')->nullable();
            $table->string('notice_answer_media_id')->comment('پاسخ تذکر')->nullable();
            $table->string('notice_to_person_actions')->comment('چکیده اقدامات دستگاه مخاطب تذکر')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_notice');
    }
};
