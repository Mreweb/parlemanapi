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
        Schema::create('person_vote_confidence_supporters', function (Blueprint $table) {
            $table->comment('افراد حامی رای اعتماد');
            $table->id('row_id');
            $table->integer('vote_confidence_supporters_person_id')->comment('شناسه فرد حامی رای اعتماد');
            $table->integer('vote_confidence_id');
            $table->foreign('vote_confidence_id')->references('vote_confidence_id')->on('person_vote_confidence')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_confidence_supporters');
    }
};
