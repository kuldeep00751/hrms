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
        Schema::create('exam_paper_mark_criterias', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('assessment_type_id');
            $table->integer('exam_paper_id');
            $table->integer('assessment_result_code_id');
            $table->decimal('range_from', 15, 2);
            $table->decimal('range_to', 15, 2);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('exam_paper_mark_criterias');
    }
};
