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
        Schema::create('person_statement_signature', function (Blueprint $table) {
            $table->comment('امضا کنندگان بیانیه نماینده');
            $table->id('row_id')->autoIncrement();
            $table->unsignedBigInteger('statement_id');
            $table->integer('statement_person_id')->index();
            $table->foreign('statement_id')->references('statement_id')->on('person_statement')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_statement_signature');
    }
};
