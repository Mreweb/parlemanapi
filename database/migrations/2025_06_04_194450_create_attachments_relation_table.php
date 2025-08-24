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
        Schema::create('attachments_relation', function (Blueprint $table) {
            $table->comment('فایل های کاربرگ');
            $table->id('row_id')->autoIncrement();
            $table->string('attachment_id')->comment('شناسه فایل');
            $table->string('worksheet_title')->nullable()->comment('مرتبط با کدام فرم');
            $table->string('worksheet_id')->comment('شناسه کاربرگ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments_relation');
    }
};
