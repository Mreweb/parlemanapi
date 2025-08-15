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
        Schema::create('person_plan_suggest_resources', function (Blueprint $table) {
            $table->comment('دستگاه های پیشنهاد دهنده');
            $table->id('row_id');
            $table->unsignedBigInteger('plan_id')->comment('شناسه طرح')->index();
            $table->integer('suggester')->comment('مراجع پیشنهاد دهنده');
            $table->foreign('plan_id')->references('plan_id')->on('person_plan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_plan_suggest_resources');
    }
};
