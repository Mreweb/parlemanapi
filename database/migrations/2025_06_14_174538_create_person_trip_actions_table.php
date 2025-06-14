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
        Schema::create('person_trip_actions', function (Blueprint $table) {
            $table->comment('اقدامات سفر');
            $table->id('row_id');
            $table->integer('trip_id')->comment('شناسه سفر');
            $table->longText('action_description')->comment('توضیح اقدامات');
            $table->foreign('trip_id')->references('trip_id')->on('person_trip')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_trip_actions');
    }
};
