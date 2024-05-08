<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_processes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('academic_intake_id');
            $table->string('process_name');
            $table->integer('academic_year_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unique(['process_name', 'academic_year_id', 'academic_intake_id'], 'unique_academic_process');
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
        Schema::drop('academic_processes');
    }
}
