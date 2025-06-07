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
        Schema::create('person_interpellation_return_opt', function (Blueprint $table) {
            $table->id('interpellation_return_opt_id');
            $table->bigInteger('interpellation_return_opt_person_id');
            $table->bigInteger('interpellation_id');
            $table->foreign('interpellation_id')->references('interpellation_id')->on('interpellations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interpellation_return_opt');
    }
};
