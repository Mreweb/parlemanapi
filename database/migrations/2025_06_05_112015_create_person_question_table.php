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
        Schema::create('person_question', function (Blueprint $table) {
            $table->id('question_id')->autoIncrement();
            $table->string('question_person_id')->comment('شخصی که سوال کننده بوده')->nullable();
            $table->string('question_president_id')->comment('در کدام شخص ریاست جمهوری تذکر داده شده')->nullable();
            $table->string('question_gov_period_id')->comment('در کدام دوره دولت')->nullable();
            $table->string('question_parliament_period_id')->comment('در کدام دوره مجلس')->nullable();
            $table->string('question_meeting')->comment('اجلاسیه')->nullable();  //
            $table->string('question_reading_date')->comment('تاریخ طرح سوال')->nullable();
            $table->string('question_register_number')->comment('شماره ثبت')->nullable();
            $table->string('question_subject')->comment('محور سوال');
            $table->string('question_summary')->comment('چکیده سوال')->nullable();
            $table->string('question_worksheet_media_id')->comment('کاربرگ سوال')->nullable();
            $table->string('question_to_person_id')->comment('مخاطب سوال')->nullable();
            $table->string('question_commission_id')->comment('کمیسیون تخصصی')->nullable();
            $table->string('question_commission_session_date')->comment('تاریخ جلسه کمیسیون')->nullable();
            $table->string('question_commission_session_result')->comment('نتیجه بررسی در کمیسیون')->nullable();
            $table->string('question_commission_receipt_date')->comment('تاریخ اعلام وصول')->nullable();
            $table->string('question_check_public_parliament_date')->comment('تاریخ بررسی در صحن علنی')->nullable();
            $table->string('question_check_public_parliament_number')->comment('شماره جلسه صحن علنی')->nullable();
            $table->string('question_check_public_parliament_result')->comment('نتیجه بررسی در صحن علنی')->nullable();
            $table->string('question_check_public_parliament_ministry_id')->comment('مخاطب سوال')->nullable();
            $table->string('question_answer_media_id')->comment('پاسخ سوال')->nullable();
            $table->string('question_to_person_actions')->comment('چکیده اقدامات دستگاه مخاطب سوال')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_question');
    }
};
