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
        Schema::create('person_trip_board', function (Blueprint $table) {
            $table->id('row_id');
            $table->integer('trip_id')->comment('شناسه سفر');
            $table->integer('board_person_id')->comment('شناسه فرد');
            $table->foreign('trip_id')->references('trip_id')->on('person_trip')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_trip_board');
    }
};
