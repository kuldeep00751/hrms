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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_number');
            $table->integer('title_id');
            $table->string('first_names');
            $table->string('surname');
            $table->string('maiden_name');
            $table->integer('marital_status_id');
            $table->integer('gender_id');
            $table->date('date_of_birth');
            $table->string('id_password');
            $table->string('ssc_number');
            $table->string('tax_number');
            $table->string('contact_number');
            $table->string('cellphone_number');
            $table->string('email_address');
            $table->string('postal_address_line_1');
            $table->string('postal_address_line_2');
            $table->string('postal_address_line_3');
            $table->string('street_address');
            $table->string('house_number');
            $table->string('suburb');
            $table->string('town');
            $table->integer('citizenship_id');
            $table->string('highest_qualification');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_code');
            $table->string('account_number');
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
        Schema::dropIfExists('employees');
    }
};
