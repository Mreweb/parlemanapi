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
        Schema::create('person_notice_signature', function (Blueprint $table) {
            $table->comment('امضا کنندگان تذکر نماینده');
            $table->id('row_id')->autoIncrement();
            $table->integer('notice_id');
            $table->integer('notice_person_id');
            $table->foreign('notice_id')->references('notice_id')->on('person_notice')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_notice_signature');
    }
};
