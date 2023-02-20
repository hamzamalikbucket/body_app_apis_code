<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->foreignId('user_id');
            $table->string('price');
            $table->date('current_date');
            $table->date('valid_till');
            $table->string('payment_method');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('purchase_courses');
    }
}
