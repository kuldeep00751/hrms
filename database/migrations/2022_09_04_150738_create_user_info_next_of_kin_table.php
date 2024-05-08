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
        Schema::create('user_info_next_of_kin', function (Blueprint $table) {
            $table->id();
            $table->integer('user_info_id');
            $table->integer('nok_relationship_id');
            $table->string('nok_full_names');
            $table->string('nok_contact_number');
            $table->string('nok_id_number');
            $table->string('nok_address_line1');
            $table->string('nok_town');
            $table->string('nok_suburb');
            $table->integer('nok_country_id');
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
        Schema::dropIfExists('user_info_next_of_kin');
    }
};
