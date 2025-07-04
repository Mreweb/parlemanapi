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
        Schema::create('person_deputy_governor_session_board', function (Blueprint $table) {
            $table->comment('افراد حاضر در جلسات با معاونین پارلمان');
            $table->id('row_id');
            $table->unsignedBigInteger('session_id')->comment('شناسه جلسه')->index();
            $table->integer('board_person_id')->comment('شناسه فرد');
            $table->foreign('session_id')->references('session_id')->on('person_deputy_governor_session')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_session_board');
    }
};
