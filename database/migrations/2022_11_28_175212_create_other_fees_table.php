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
        Schema::create('other_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_type_id');
            $table->integer('academic_year_id');
            $table->integer('created_by');
            $table->decimal('amount', 15, 2);
            $table->integer('student_type_id');
            $table->string('academic_process');
            $table->unique(['fee_type_id', 'academic_year_id', 'student_type_id', 'qualification_id', 'year_level_id'], 'other_fees_unique');
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
        Schema::dropIfExists('other_fees');
    }
};
