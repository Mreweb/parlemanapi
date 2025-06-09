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
        Schema::create('president_cabinet', function (Blueprint $table) {
            $table->id('row_id')->primary();
            $table->integer('president_id');
            $table->string('cabinet',100);//enum gov cabinet
            $table->integer('cabinet_person_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('president_id')->references('president_id')->on('president')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('president_cabinet');
    }
};
