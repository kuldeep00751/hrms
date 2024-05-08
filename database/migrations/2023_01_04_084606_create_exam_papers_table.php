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
        Schema::create('exam_papers', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('assessment_type_id');
            $table->string('paper_name');
            $table->decimal('minimum_pass_mark', 15, 2);
            $table->decimal('weight', 15, 2);
            $table->integer('assessment_result_code_id');
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
        Schema::dropIfExists('exam_papers');
    }
};
