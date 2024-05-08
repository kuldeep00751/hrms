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
        Schema::table('user_info_next_of_kin', function (Blueprint $table) {
            $table->string('nok_id_number')->nullable()->change();
            $table->string('nok_address_line1')->nullable()->change();
            $table->string('nok_town')->nullable()->change();
            $table->string('nok_suburb')->nullable()->change();
            $table->string('nok_country_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_info_next_of_kin', function (Blueprint $table) {
            //
        });
    }
};
