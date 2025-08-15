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
        Schema::create('person_plan_signatures', function (Blueprint $table) {
            $table->comment('افراد امضا کننده');
            $table->id();
            $table->unsignedBigInteger('plan_id')->comment('شناسه طرح')->index();
            $table->integer('plan_person_id')->comment('فرد');
            $table->foreign('plan_id')->references('plan_id')->on('person_plan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_plan_sub_signatures');
    }
};
