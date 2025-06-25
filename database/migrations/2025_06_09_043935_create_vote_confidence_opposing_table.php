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
        Schema::create('person_vote_confidence_opposing', function (Blueprint $table) {
            $table->comment('مخالفان رای اعتماد');
            $table->id('row_id');
            $table->integer('vote_confidence_opposing_person_id')->comment('شناسه فرد مخالف رای اعتماد')->index("v_c_o_p_id");
            $table->unsignedBigInteger('vote_confidence_id')->index();
            $table->foreign('vote_confidence_id')->references('vote_confidence_id')->on('person_vote_confidence')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_confidence_opposing');
    }
};
