<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('person_requests_track', function (Blueprint $table) {
            $table->id('row_id')->autoIncrement();
            $table->string('request_id')->comment('شناسه درخواست');
            $table->string('request_commission_title')->comment('ارجا به مبادی ذیربط');
            $table->string('request_subject_title')->comment('سوابق موضوع');
            $table->string('request_subject_description')->comment('شرح پیگیری');
            $table->string('request_subject_result')->comment('نتیجه نهایی');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_requests_track');
    }
};
