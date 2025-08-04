<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_enactment', function (Blueprint $table) {
            $table->comment('شناسنامه لایحه');
            $table->unsignedBigInteger('enactment_id')->primary();
            $table->string('enactment_person_id')->comment('نام نماینده لایحه')->index();
            $table->string('enactment_title')->comment('عنوان طرح');
            $table->string('enactment_content')->comment('متن لایحه');
            $table->string('enactment_prev_title')->comment('عنوان قبل');
            $table->string('enactment_date')->comment('تاریخ اعلام وصول')->index();
            $table->string('enactment_president_id')->comment('رئیس جمهور')->index();
            $table->string('enactment_gov_period_id')->comment('شماره دولت')->index();
            $table->string('enactment_parliament_period_id')->comment('شماره مجلس')->index();
            $table->string('enactment_president_letter_number')->comment('شماره نامه رئیس جمهور به مجلس');
            $table->string('enactment_president_letter_date')->comment('تاریخ نامه رئیس جمهور به مجلس');
            $table->string('enactment_president_deputy_letter_number')->comment('شماره نامه معاون رئیس جمهور به مجلس');
            $table->string('enactment_president_deputy_letter_date')->comment('تاریخ نامه معاون رئیس جمهور به مجلس');
            $table->string('enactment_ministry')->comment('دستگاه پیشنهاد دهنده');
            $table->string('enactment_priority')->comment('نحوه اعلام وصول');
            $table->string('enactment_register_number')->comment('شماره ثبت');
            $table->string('enactment_print_number')->comment('شماره چاپ');
            $table->string('enactment_print_date')->comment('تاریخ چاپ');
            $table->string('enactment_prev_register_number')->comment('شماره ثبت قبلی');
            $table->string('enactment_period')->comment('دوره');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_enactment');
    }
};
