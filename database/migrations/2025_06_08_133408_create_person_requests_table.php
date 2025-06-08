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
        Schema::create('person_requests', function (Blueprint $table) {
            $table->id('request_id')->autoIncrement();
            $table->string('request_title')->comment('عنوان درخواست');
            $table->string('request_date')->comment('تاریخ درخواست');
            $table->string('request_place')->comment('مکان درخواست');
            $table->string('request_phone')->comment('تلفن تماس');
            $table->longText('request_description')->comment('شرح درخواست');
            $table->longText('request_command')->comment('دستور لازم');
            $table->string('request_serial')->comment('شماره درخواست');
            $table->string('request_person_id')->comment('نماینده درخواست کننده');
            $table->string('request_president_id')->comment('رئیس جمهور');
            $table->string('request_gov_period_id')->comment('شماره دولت');
            $table->string('request_parliament_period_id')->comment('دوره مجلس');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_requests');
    }
};
