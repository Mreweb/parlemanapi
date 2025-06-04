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
        Schema::create('person', function (Blueprint $table) {
            $table->id('person_id');
            $table->string('person_name')->nullable();
            $table->string('person_last_name');
            $table->string('person_national_code')->unique();
            $table->string('person_phone')->unique();
            $table->string('person_email')->nullable();
            $table->enum('person_gender',['male','female'])->nullable();
            $table->integer('person_province_id');
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('otp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
