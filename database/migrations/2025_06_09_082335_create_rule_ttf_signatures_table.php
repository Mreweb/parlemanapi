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
        Schema::create('rule_ttf_signatures', function (Blueprint $table) {
            $table->id('row_id');
            $table->bigInteger('rule_ttf_supporters_person_id')->comment('نمایندگان امضا کننده');
            $table->bigInteger('rule_ttf_id');
            $table->foreign('rule_ttf_id')->references('rule_ttf_id')->on('rule_ttf')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_ttf_signatures');
    }
};
