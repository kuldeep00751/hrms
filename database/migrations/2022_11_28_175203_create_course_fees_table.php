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
        Schema::create('course_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('qualification_id');
            $table->integer('academic_year_id');
            $table->integer('created_by');
            $table->decimal('amount', 15, 2);
            $table->integer('student_type_id');
            $table->string('academic_process');
            $table->unique(['qualification_id', 'academic_year_id', 'student_type_id'], 'course_fees_unique');
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
        Schema::dropIfExists('course_fees');
    }
};
