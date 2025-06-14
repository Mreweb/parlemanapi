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

        Schema::create('person_projects', function (Blueprint $table) {
            $table->comment('طرح های نماینده');
            $table->id('project_id')->autoIncrement();
            $table->string('project_title')->comment('عنوان طراح');
            $table->string('project_register_number')->comment('شماره ثبت');
            $table->string('project_create_date')->comment('تاریخ اعلام وصول');
            $table->enum('project_priority',['priority_normal','priority_step_1','priority_step_2','priority_step_3'])->comment('فوریت');
            $table->enum('project_handle_way',['conversation_step_1','conversation_step_2','conversation_step_85'])->comment('نحوه رسیدگی');
            $table->enum('project_topic_relevance',['full','middle','zero'])->comment('تاریخ');
            $table->enum('project_government_vote',['reject','accept','editable'])->comment('تاریخ');
            $table->enum('project_status',['reject','accept'])->comment('تاریخ');
            $table->string('project_end_date')->comment('اقدامات');
            $table->string('project_person_id')->comment('نماینده درخواست کننده	');
            $table->string('project_president_id')->comment('رئیس جمهور	');
            $table->string('project_gov_period_id')->comment('شماره دولت');
            $table->string('project_parliament_period_id')->comment('دوره مجلس');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_projects');
    }
};
