<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id');
            $table->string('heading');
            $table->string('opt_1');
            $table->string('opt_2');
            $table->string('opt_3');
            $table->string('opt_4');
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
        Schema::dropIfExists('topic_questions');
    }
}
