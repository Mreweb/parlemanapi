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
        Schema::create('person_speech_signature', function (Blueprint $table) {
            $table->comment('امضا کنندگان نطق نماینده');
            $table->id('row_id')->autoIncrement();
            $table->unsignedBigInteger('speech_id');
            $table->integer('speech_person_id')->index();
            $table->foreign('speech_id')->references('speech_id')->on('person_speech')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_speech_signature');
    }
};
