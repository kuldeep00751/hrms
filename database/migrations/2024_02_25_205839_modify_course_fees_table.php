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
        Schema::table('course_fees', function (Blueprint $table) {
            // Drop existing unique constraint
            Schema::table('course_fees', function (Blueprint $table) {
                $table->dropUnique('course_fees_unique');
            });

            // Add new unique constraint with a combination of columns
            Schema::table('course_fees', function (Blueprint $table) {
                $table->unique(['qualification_id', 'year_level_id', 'academic_year_id', 'student_type_id'], 'course_fees_combined_unique');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_fees', function (Blueprint $table) {
            // Drop the new unique constraint if needed
            Schema::table('course_fees', function (Blueprint $table) {
                $table->dropUnique('course_fees_combined_unique');
            });

            // Recreate the old unique constraint if needed
            Schema::table('course_fees', function (Blueprint $table) {
                $table->unique(['course_fees'], 'course_fees_unique');
            });
        });
    }
};
