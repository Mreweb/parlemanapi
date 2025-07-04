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
        Schema::create('person_commission', function (Blueprint $table) {
            $table->comment('کمیسیون نماینده');
            $table->id('row_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('commission_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_commission');
    }
};
