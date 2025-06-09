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
        Schema::create('person_research_signatures', function (Blueprint $table) {
            $table->id('row_id');
            $table->bigInteger('person_research_signature_person_id')->comment('شناسه فرد امضا کننده تحقیق');
            $table->bigInteger('person_research_id');
            $table->foreign('person_research_id')->references('person_research_id')->on('person_research_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_research_signatures');
    }
};
