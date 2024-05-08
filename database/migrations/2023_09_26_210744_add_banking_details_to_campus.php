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
        Schema::table('campuses', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('address_line_3');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('branch_name')->nullable()->after('account_number');
            $table->string('branch_code')->nullable()->after('branch_name');
            $table->string('swift_code')->nullable()->after('branch_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campuses', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('account_number');
            $table->dropColumn('branch_name');
            $table->dropColumn('branch_code');
            $table->dropColumn('swift_code');
        });
    }
};
