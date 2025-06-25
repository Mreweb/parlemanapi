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
        Schema::create('person_rule_ttf_signatures', function (Blueprint $table) {
            $table->comment('امضا کنندگان ماده 234');
            $table->id('row_id');
            $table->integer('rule_ttf_supporters_person_id')->comment('نمایندگان امضا کننده')->index("r_t_s_p_id");
            $table->unsignedBigInteger('rule_ttf_id')->index();
            $table->foreign('rule_ttf_id')->references('rule_ttf_id')->on('person_rule_ttf')->onDelete('cascade');
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
