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
        Schema::create('person_projects_related_commission', function (Blueprint $table) {
            $table->comment('کمیسیون های مرتبط');
            $table->id('row_id')->autoIncrement();
            $table->integer('projects_related_commission_id')->comment('شناسه کمیسیون مرتبط')->index("p_r_c_id");
            $table->unsignedBigInteger('projects_project_id')->comment('شناسه طراح')->index("p_p_id");
            $table->foreign('projects_project_id')->references('project_id')->on('person_projects')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_projects_related_commission');
    }
};
