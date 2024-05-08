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
        Schema::create('exam_module_papers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('study_mode_id');
            $table->integer('academic_intake_id');
            $table->integer('assessment_type_id');
            $table->integer('campus_id');
            $table->integer('exam_paper_id');
            $table->decimal('mark', 15,2);
            $table->char('pass_fail');
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
        Schema::dropIfExists('exam_module_papers');
    }
};
