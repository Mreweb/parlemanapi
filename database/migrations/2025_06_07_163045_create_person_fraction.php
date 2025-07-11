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
        Schema::create('person_fraction', function (Blueprint $table) {
            $table->comment('فراکسیون نماینده');
            $table->id('row_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('fraction_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_fraction');
    }
};
