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
        Schema::create('person_meeting', function (Blueprint $table) {
            $table->comment('ملاقات های نماینده');
            $table->integer('meeting_id')->autoIncrement();
            $table->string('meeting_title')->comment('شرح مصوبه');
            $table->string('meeting_description')->comment('توضیحات');
            $table->enum('meeting_status',['done','undone'])->comment('وضعیت');
            $table->string('meeting_end_date')->comment('تاریخ خاتمه');
            $table->string('meeting_tasks')->comment('اقدامات انجام شده	');
            $table->string('meeting_person_id')->comment('نماینده درخواست کننده	');
            $table->string('meeting_president_id')->comment('رئیس جمهور	');
            $table->string('meeting_gov_period_id')->comment('شماره دولت');
            $table->string('meeting_parliament_period_id')->comment('دوره مجلس');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_meeting');
    }
};
