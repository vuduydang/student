<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name',100);
            $table->string('phone',12)->unique()->nullable();
            $table->date('birthday');
            $table->integer('course_id')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar');
            $table->tinyInteger('gender')->nullable();
            $table->string('email',100)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
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
        Schema::table('students', function (Blueprint $table) {
            Schema::dropIfExists('students');
        });
    }
}
