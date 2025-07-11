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
        Schema::create('person_projects_participation', function (Blueprint $table) {
            $table->comment('امضا کنندگان طرخ');
            $table->id('row_id')->autoIncrement();
            $table->unsignedBigInteger('projects_participation_person_id')->comment('شناسه فرد مشارکت کننده در طرح')->index("p_p_pid");
            $table->unsignedBigInteger('projects_project_id')->comment('شناسه طرح')->index("p_p_id");
            $table->foreign('projects_project_id')->references('project_id')->on('person_projects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_projects_participation');
    }
};
