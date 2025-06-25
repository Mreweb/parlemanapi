<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_meeting_track', function (Blueprint $table) {
            $table->comment('پیگیری ملاقات های نماینده');
            $table->id('row_id')->autoIncrement();
            $table->unsignedBigInteger('meeting_track_meeting_id')->comment('شناسه ملاقات')->index();
            $table->longText('meeting_track_description')->comment('اقدام انجام شده');
            $table->foreign('meeting_track_meeting_id')->references('meeting_id')->on('person_meeting')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_meeting_track');
    }
};
