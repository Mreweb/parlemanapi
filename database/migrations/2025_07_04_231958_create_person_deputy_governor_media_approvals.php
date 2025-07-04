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
        Schema::create('person_deputy_governor_media_approvals', function (Blueprint $table) {
            $table->comment('مصوبات نشست رسانه ای');
            $table->id('row_id');
            $table->unsignedBigInteger('media_id')->comment('شناسه نشست')->index();
            $table->longText('approval_description')->comment('مصوبات نشست');
            $table->foreign('media_id')->references('media_id')->on('person_deputy_governor_media')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_media_approvals');
    }
};
