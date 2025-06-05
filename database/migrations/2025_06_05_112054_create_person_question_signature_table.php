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
        Schema::create('person_question_signature', function (Blueprint $table) {
            $table->id('row_id')->autoIncrement();
            $table->bigInteger('question_id');
            $table->bigInteger('question_person_id');
            $table->foreign('question_id')->references('question_id')->on('person_question')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_question_signature');
    }
};
