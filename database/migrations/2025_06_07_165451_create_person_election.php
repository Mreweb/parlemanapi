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
        Schema::create('person_election', function (Blueprint $table) {
            $table->comment('حوزه انتخابیه نماینده');
            $table->id('row_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('election_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_election');
    }
};
