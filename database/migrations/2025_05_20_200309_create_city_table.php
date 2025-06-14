<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('city', function (Blueprint $table) {
            $table->comment('فهرست شهرها');
            $table->integer('city_id')->autoIncrement();
            $table->string('city_name', 100)->comment('نام شهر');
            $table->integer('city_province_id')->comment('شناسه استان');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city');
    }
};
