integer<?php

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
        Schema::create('person_interpellation_signatories', function (Blueprint $table) {

            $table->comment('امضا کنندگان استیضاح نماینده');
            $table->id('interpellation_signature_id');
            $table->unsignedBigInteger('interpellation_signature_person_id')->index("signature_person_id");
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
        Schema::dropIfExists('interpellation_signatories');
    }
};
