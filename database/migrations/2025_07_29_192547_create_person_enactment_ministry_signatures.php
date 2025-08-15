<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_enactment_ministry_signatures', function (Blueprint $table) {
            $table->comment('وزرای امضا کننده');
            $table->id();
            $table->unsignedBigInteger('enactment_id')->comment('شناسه لایحه')->index();
            $table->integer('enactment_person_id')->comment('مرجع پیشنهاد دهنده');
            $table->foreign('enactment_id')->references('enactment_id')->on('person_enactment')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_enactment_ministry_signatures');
    }
};
