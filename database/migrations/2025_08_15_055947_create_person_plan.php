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
        Schema::create('person_plan', function (Blueprint $table) {
            $table->comment('شناسنامه طرح');
            $table->unsignedBigInteger('plan_id')->primary()->autoIncrement();
            $table->string('plan_person_id')->comment('نام نماینده طرح')->index();
            $table->string('plan_title')->comment('عنوان طرح');
            $table->string('plan_content')->comment('متن طرح');
            $table->string('plan_prev_title')->comment('عنوان قبل');
            $table->string('plan_date')->comment('تاریخ اعلام وصول')->index();
            $table->string('plan_president_id')->comment('رئیس جمهور')->index();
            $table->string('plan_gov_period_id')->comment('شماره دولت')->index();
            $table->string('plan_parliament_period_id')->comment('شماره مجلس')->index();
            $table->string('plan_meeting')->comment('اجلاسیه')->index();
            $table->string('plan_priority')->comment('نحوه اعلام وصول');
            $table->string('plan_register_number')->comment('شماره ثبت');
            $table->string('plan_print_number')->comment('شماره چاپ');
            $table->string('plan_print_date')->comment('تاریخ چاپ');
            $table->string('plan_prev_register_number')->comment('شماره ثبت قبلی');
            $table->string('plan_period')->comment('دوره');
            $table->string('plan_gov_opinion')->comment('نظر دولت نسبت به طرح');
            $table->string('plan_gov_register_date')->comment('تاریخ مصوبه دولت');
            $table->string('plan_gov_register_number')->comment('شماره مصوبه دولت');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_plan');
    }
};
