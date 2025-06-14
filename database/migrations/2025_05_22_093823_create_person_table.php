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
        Schema::create('person', function (Blueprint $table) {
            $table->comment('افراد');
            $table->id('person_id');
            $table->string('person_name', 100)->nullable()->comment('نام');
            $table->string('person_last_name', 100)->comment('نام خانوادگی');
            $table->string('person_national_code', 15)->unique()->comment('کد ملی');
            $table->string('person_phone', 14)->unique()->comment('تلفن همراه');
            $table->string('person_email', 100)->nullable()->comment('لایمی');
            $table->enum('person_gender',['male','female'])->nullable()->comment('جنسیت');
            $table->integer('person_province_id')->comment('استان');
            $table->string('person_role',40)->comment('نقش');
            $table->string('username', 100)->comment('نام کاربری');
            $table->string('password')->comment('رمز عبور');
            $table->string('otp',10)->nullable()->comment('کد یکتا');
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
