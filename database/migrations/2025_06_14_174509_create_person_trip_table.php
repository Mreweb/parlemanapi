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
        Schema::create('person_trip', function (Blueprint $table) {
            $table->comment('سفرهای نماینده');
            $table->id('trip_id')->autoIncrement();
            $table->string('trip_president_id')->comment('رئیس جمهور')->index();
            $table->string('trip_person_id')->comment('نام نماینده متقاضی ماده 45')->index();
            $table->string('trip_gov_period_id')->comment('شماره دولت')->index();
            $table->string('trip_parliament_period_id')->comment('شماره مجلس')->index();
            $table->string('trip_start_date')->comment('تاریخ شروع سفر');
            $table->string('trip_end_date')->comment('تاریخ پایان سفر');
            $table->string('trip_province_id')->comment('استان مقصد');
            $table->longText('trip_description')->comment('توضیحات');
            $table->string('trip_subject')->comment('موضوع سفر');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_person_trip');
    }
};
