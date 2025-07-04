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
        Schema::create('person_rule_forty_five_signatures', function (Blueprint $table) {
            $table->comment('امضا کنندگان ماده 45');
            $table->id('row_id');
            $table->integer('rule_forty_five_supporters_person_id')->comment('نمایندگان امضا کننده')->index("r_f_s_p_id");
            $table->unsignedBigInteger('rule_forty_five_id')->index();
            $table->foreign('rule_forty_five_id')->references('rule_forty_five_id')->on('person_rule_forty_five')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_forty_five_signatures');
    }
};
