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
        Schema::create('person_plan_bill_85_review', function (Blueprint $table) {
            $table->comment('بررسی لایحه طبق اصل 85 قانون اساسی');
            $table->id('row_id')->autoIncrement();
            $table->longText('plan_detail')->comment('داده های جیسون بررسی لایحه طبق اصل 85 قانون اساسی');
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
        Schema::dropIfExists('person_plan_bill_85_review');
    }
};
