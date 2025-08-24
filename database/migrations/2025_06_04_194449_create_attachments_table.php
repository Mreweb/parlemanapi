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
        Schema::create('attachments', function (Blueprint $table) {
            $table->comment('فایل ها');
            $table->id('row_id')->autoIncrement();
            $table->string('attachment_id')->comment('شناسه فایل');
            $table->string('attachment_title')->nullable()->comment('عنوان فایل');
            $table->string('path')->comment('مسیر فایل');
            $table->longText('base_64')->comment('محتوای فایل بصورت بیس 64');
            $table->string('extension')->comment('پسوند فایل');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
