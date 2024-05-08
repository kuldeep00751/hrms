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
        Schema::create('subject_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('academic_year_id');
            $table->integer('created_by');
            $table->decimal('amount', 15,2);
            $table->integer('assessment_type_id');
            $table->integer('student_type_id');
            $table->string('academic_process');
            $table->unique(['module_id', 'academic_year_id', 'student_type_id', 'assessment_type_id'],'subject_fees_unx');
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
        Schema::dropIfExists('subject_fees');
    }
};
