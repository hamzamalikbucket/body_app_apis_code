<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_topics', function (Blueprint $table) {
            $table->dropColumn('pdf');
            $table->dropColumn('videoLink');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_topics', function (Blueprint $table) {
            $table->string('pdf');
            $table->string('videoLink');
        });
    }
}
