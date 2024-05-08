<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_admission_criterias', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('assessment_result_code_id');
            $table->decimal('minimum_ca_mark');
            $table->decimal('ca_weight', 15, 2);
            $table->decimal('exam_weight', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_admission_criterias');
    }
};
