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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('financial_year_id');
            $table->string('reference');
            $table->date('transaction_date');
            $table->string('transaction_description');
            $table->string('transaction_type');
            $table->string('model_type');
            $table->string('model_id');
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
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
        Schema::dropIfExists('student_accounts');
    }
};
