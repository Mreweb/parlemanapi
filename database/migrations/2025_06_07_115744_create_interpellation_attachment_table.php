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
        Schema::create('person_interpellation_attachment', function (Blueprint $table) {
            $table->comment('فایل های تحقیق و تفحص');
            $table->id('interpellation_opt_id');
            $table->string('interpellation_attachment_title')->comment('نام فایل');
            $table->mediumText('interpellation_attachment_src')->comment('مسیر فایل');
            $table->unsignedBigInteger('interpellation_id')->index();
            $table->foreign('interpellation_id')->references('interpellation_id')->on('person_interpellations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_interpellation_attachment');
    }
};
