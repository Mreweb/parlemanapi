<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_vote_confidence_attachment', function (Blueprint $table) {
            $table->comment('فایل های رای اعتماد');
            $table->id('row_id');
            $table->string('vote_confidence_attachment_title')->comment('نام فایل');
            $table->mediumText('vote_confidence_attachment_src')->comment('مسیر فایل');
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
        Schema::dropIfExists('person_vote_confidence_attachment');
    }
};
