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
        Schema::create('person_plan_sub_commission', function (Blueprint $table) {
            $table->comment('کمیسیون های فرعی طرح');
            $table->id('row_id')->autoIncrement();
            $table->integer('commission_id')->comment('شناسه کمیسیون');
            $table->unsignedBigInteger('plan_id')->comment('شناسه طرح');
            $table->foreign('plan_id')->references('plan_id')->on('person_plan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_plan_sub_commission');
    }
};
