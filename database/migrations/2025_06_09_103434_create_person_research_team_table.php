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
        Schema::create('person_research_team', function (Blueprint $table) {
            $table->comment('اعضای هیات تحقیق و تفحص');
            $table->id('row_id');
            $table->integer('person_research_team_person_id')->comment('شناسه فرد در تیم تحقیق');
            $table->integer('person_research_id');
            $table->foreign('person_research_id')->references('person_research_id')->on('person_research')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_research_team');
    }
};
