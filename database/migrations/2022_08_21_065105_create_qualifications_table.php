<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('qualification_name');
            $table->string('qualification_code')->unique();
            $table->integer('number_of_years');
            $table->integer('nqf_level_id');
            $table->integer('qualification_credits');
            $table->integer('qualification_type_id');
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
        Schema::drop('qualifications');
    }
}
