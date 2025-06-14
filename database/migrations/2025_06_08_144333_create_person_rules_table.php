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
        Schema::create('person_rules', function (Blueprint $table) {
            $table->comment('قوانین مصوب شده');
            $table->id('rule_id')->autoIncrement();
            $table->string('rule_preparation')->comment('مقدمات قانون');
            $table->string('rule_executive_branch')->comment('قواعد روابط شعبه اجرایی');
            $table->string('rule_history')->comment('سوابق قبلی');
            $table->string('rule_approve_date')->comment('تاریخ تصویب');
            $table->string('rule_president_notification_number')->comment('شماره ابلاغ رئیس جمهور');
            $table->string('rule_president_notification_date')->comment('تاریخ ابلاغ رئیس جمهور');
            $table->string('rule_person_id')->comment('نماینده درخواست کننده');
            $table->string('rule_president_id')->comment('رئیس جمهور');
            $table->string('rule_gov_period_id')->comment('شماره دولت');
            $table->string('rule_parliament_period_id')->comment('دوره مجلس');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_rules');
    }
};
