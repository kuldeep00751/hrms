<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('passport_photo')->nullable();
            $table->string('student_number')->nullable();
            $table->integer('title_id')->nullable();
            $table->string('surname')->nullable();
            $table->string('first_names')->nullable();
            $table->string('maiden_name')->nullable();
            $table->integer('gender_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('id_number')->nullable();
            $table->string('citizenship_status')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('last_school_attended')->nullable();
            $table->integer('highest_grade')->nullable();
            $table->integer('education_system_id')->nullable();
            $table->integer('year_completed')->nullable();
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
        Schema::dropIfExists('user_infos');
    }
}
