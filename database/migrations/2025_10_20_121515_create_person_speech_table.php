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
        Schema::create('person_speech', function (Blueprint $table) {
            $table->comment('نطق های نماینده');
            $table->id('speech_id')->autoIncrement();
            $table->integer('speech_person_id')->comment('شخصی که نطق دهنده بوده')->nullable()->index();
            $table->integer('speech_president_id')->comment('در کدام شخص ریاست جمهوری نطق داده شده')->nullable()->index();
            $table->integer('speech_gov_period_id')->comment('در کدام دوره دولت')->nullable()->index();
            $table->integer('speech_parliament_period_id')->comment('در کدام دوره مجلس')->nullable()->index();
            $table->string('speech_meeting')->comment('اجلاسیه')->nullable();
            $table->enum('speech_type',[1,2,3,4,5])->comment('نوع نطق')->nullable();
            $table->string('speech_reading_date', 100)->comment('تاریخ قرائت')->nullable();
            $table->string('speech_public_court_reading_date', 100)->comment('تاریخ قرائت در صحن')->nullable();
            $table->string('speech_register_number', 100)->comment('شماره ثبت')->nullable();
            $table->string('speech_session_number', 100)->comment('شماره جلسه علنی صحن مجلس')->nullable();
            $table->string('speech_subject', 100)->comment('عنوان نطق');
            $table->longText('speech_summary')->comment('چکیده نطق')->nullable();
            $table->integer('speech_to_person_id')->comment('مخاطب نطق')->nullable();
            $table->integer('speech_ministry_id')->comment('دستگاه نطق')->nullable();
            $table->integer('speech_designer_person_id')->comment('طراح نطق')->nullable();
            $table->longText('speech_to_person_actions')->comment('چکیده اقدامات دستگاه مخاطب نطق')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_speech');
    }
};
