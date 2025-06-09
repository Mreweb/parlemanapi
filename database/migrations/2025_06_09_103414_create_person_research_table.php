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
        Schema::create('person_research', function (Blueprint $table) {
            $table->integer('person_research_id')->autoIncrement();
            $table->string('person_research_president_id')->comment('رئیس جمهور');
            $table->string('person_research_person_id')->comment('نام نماینده طراح تحقیق و تفحص');
            $table->string('person_research_gov_period_id')->comment('شماره دولت');
            $table->string('person_research_parliament_period_id')->comment('شماره مجلس');
            $table->string('person_research_meeting')->comment('اجلاسیه');
            $table->string('person_research_register_number')->comment('شماره ثبت');
            $table->string('person_research_register_date')->comment('تاریخ ثبت');
            $table->string('person_research_subject')->comment('موضوع تحقیق');
            $table->string('person_research_summary')->comment('چکیده تحقیق');
            $table->string('person_research_worksheet_media_id')->comment('کاربرگ تحقیق');
            $table->string('person_research_commission_id')->comment('کمیسیون تخصصی');
            $table->string('person_research_commission_result')->comment('نتیجه در کمیسیون تخصصی');
            $table->string('person_research_commission_number')->comment('شماره جلسه صحن علنی');
            $table->string('person_research_public_court_date')->comment('تاریخ طرح در صحن علنی');
            $table->string('person_research_public_court_result')->comment('نتیجه طرح در صحن علنی');
            $table->string('person_research_team_result')->comment('نتیجه نهایی هیأت تحقیق و تفحص');
            $table->string('person_research_team_result_ministry_id')->comment('دستگاه ذیربط');
            $table->longText('person_research_contents_summary')->comment('چکیده اقدامات دستگاه مخاطب');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_research');
    }
};
