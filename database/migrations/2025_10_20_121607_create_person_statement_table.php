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
        Schema::create('person_statement', function (Blueprint $table) {
            $table->comment('بیانیه های نماینده');
            $table->id('statement_id')->autoIncrement();
            $table->integer('statement_person_id')->comment('شخصی که بیانیه دهنده بوده')->nullable()->index();
            $table->integer('statement_president_id')->comment('در کدام شخص ریاست جمهوری بیانیه داده شده')->nullable()->index();
            $table->integer('statement_gov_period_id')->comment('در کدام دوره دولت')->nullable()->index();
            $table->integer('statement_parliament_period_id')->comment('در کدام دوره مجلس')->nullable()->index();
            $table->string('statement_meeting')->comment('اجلاسیه')->nullable();
            $table->enum('statement_type',[1,2,3,4,5])->comment('نوع بیانیه')->nullable();
            $table->string('statement_reading_date', 100)->comment('تاریخ قرائت')->nullable();
            $table->string('statement_public_court_reading_date', 100)->comment('تاریخ قرائت در صحن')->nullable();
            $table->string('statement_register_number', 100)->comment('شماره ثبت')->nullable();
            $table->string('statement_session_number', 100)->comment('شماره جلسه علنی صحن مجلس')->nullable();
            $table->string('statement_subject', 100)->comment('عنوان بیانیه');
            $table->longText('statement_summary')->comment('چکیده بیانیه')->nullable();
            $table->integer('statement_to_person_id')->comment('مخاطب بیانیه')->nullable();
            $table->integer('statement_ministry_id')->comment('دستگاه بیانیه')->nullable();
            $table->integer('statement_designer_person_id')->comment('طراح بیانیه')->nullable();
            $table->longText('statement_to_person_actions')->comment('چکیده اقدامات دستگاه مخاطب بیانیه')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_statement');
    }
};
