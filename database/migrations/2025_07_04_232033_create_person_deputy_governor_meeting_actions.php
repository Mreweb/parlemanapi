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
        Schema::create('person_deputy_governor_meeting_actions', function (Blueprint $table) {
            $table->comment('اقدامات دیدار با معاونین مجمع استانی');
            $table->id('row_id');
            $table->unsignedBigInteger('meeting_id')->comment('شناسه دیدار')->index();
            $table->longText('action_description')->comment('توضیح اقدامات');
            $table->foreign('meeting_id')->references('meeting_id')->on('person_deputy_governor_meeting')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_deputy_governor_meeting_actions');
    }
};
