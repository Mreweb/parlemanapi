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
        Schema::create('person_deputy_governor_trip_approvals', function (Blueprint $table) {
            $table->comment('مصوبات سفر سفرهای استانی معاون استان');
            $table->id('row_id');
            $table->unsignedBigInteger('trip_id')->comment('شناسه سفر')->index();
            $table->longText('approval_description')->comment('مصوبات سفر');
            $table->foreign('trip_id')->references('trip_id')->on('person_deputy_governor_trip')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_trip_approvals');
    }
};
