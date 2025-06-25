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
        Schema::create('election_location_city', function (Blueprint $table) {
            $table->comment('شهرهای حوزه انتخابیه');
            $table->id('row_id')->autoIncrement();
            $table->unsignedBigInteger('election_location_id');
            $table->unsignedBigInteger('election_location_city_id')->index();
            $table->foreign('election_location_id')->references('election_location_id')->on('election_location')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('election_location_city');
    }
};
