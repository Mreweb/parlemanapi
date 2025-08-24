<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_research_attachment', function (Blueprint $table) {
            $table->comment('فایل های تحقیق و تفحص');
            $table->id('row_id');
            $table->string('person_research_attachment_title')->comment('نام فایل');
            $table->mediumText('person_research_attachment_src')->comment('مسیر فایل');
            $table->unsignedBigInteger('person_research_id')->index();
            $table->foreign('person_research_id')->references('person_research_id')->on('person_research')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_research_attachment');
    }
};
