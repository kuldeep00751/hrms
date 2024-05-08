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
        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('nta_candidate_number')->after('email_address')->nullable();
            $table->string('postal_address_line_1')->after('nta_candidate_number')->nullable();
            $table->string('postal_address_line_2')->after('postal_address_line_1')->nullable();
            $table->string('postal_address_line_3')->after('postal_address_line_2')->nullable();

            $table->string('residential_address_line_1')->after('postal_address_line_3')->nullable();
            $table->string('residential_address_line_2')->after('residential_address_line_1')->nullable();
            $table->string('residential_address_line_3')->after('residential_address_line_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn('postal_address_line_1');
            $table->dropColumn('postal_address_line_2');
            $table->dropColumn('postal_address_line_3');
            $table->dropColumn('residential_address_line_1');
            $table->dropColumn('residential_address_line_2');
            $table->dropColumn('residential_address_line_3');
        });
    }
};
