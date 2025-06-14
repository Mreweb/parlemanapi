<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_interpellations_opposing', function (Blueprint $table) {
            $table->comment('مخالف های استیضاح');
            $table->id('interpellations_opposing_id');
            $table->integer('interpellations_opposing_person_id');
            $table->integer('interpellation_id');
            $table->foreign('interpellation_id')->references('interpellation_id')->on('person_interpellations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interpellations_opposing');
    }
};
