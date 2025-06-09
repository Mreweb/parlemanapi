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
            $table->integer('question_id')->autoIncrement();
            $table->integer('question_person_id')->comment('شخصی که سوال کننده بوده')->nullable();
            $table->integer('question_president_id')->comment('در کدام شخص ریاست جمهوری تذکر داده شده')->nullable();
            $table->integer('question_gov_period_id')->comment('در کدام دوره دولت')->nullable();
            $table->integer('question_parliament_period_id')->comment('در کدام دوره مجلس')->nullable();
            $table->string('question_meeting', 100)->comment('اجلاسیه')->nullable();
            $table->string('question_reading_date', 100)->comment('تاریخ طرح سوال')->nullable();
            $table->string('question_register_number', 100)->comment('شماره ثبت')->nullable();
            $table->string('question_subject', 100)->comment('محور سوال');
            $table->longText('question_summary')->comment('چکیده سوال')->nullable();
            $table->string('question_worksheet_media_id', 100)->comment('کاربرگ سوال')->nullable();
            $table->integer('question_to_person_id')->comment('مخاطب سوال')->nullable();
            $table->integer('question_commission_id')->comment('کمیسیون تخصصی')->nullable();
            $table->string('question_commission_session_date', 100)->comment('تاریخ جلسه کمیسیون')->nullable();
            $table->enum('question_commission_session_result',[1,2,3,4])->comment('نتیجه بررسی در کمیسیون')->nullable();
            $table->string('question_commission_receipt_date', 100)->comment('تاریخ اعلام وصول')->nullable();
            $table->string('question_check_public_parliament_date', 100)->comment('تاریخ بررسی در صحن علنی')->nullable();
            $table->string('question_check_public_parliament_number', 100)->comment('شماره جلسه صحن علنی')->nullable();
            $table->enum('question_check_public_parliament_result',[1,2,3,4])->comment('نتیجه بررسی در صحن علنی')->nullable();
            $table->integer('question_check_public_parliament_ministry_id')->comment('مخاطب سوال')->nullable();
            $table->string('question_answer_media_id', 100)->comment('پاسخ سوال')->nullable();
            $table->longText('question_to_person_actions')->comment('چکیده اقدامات دستگاه مخاطب سوال')->nullable();
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
