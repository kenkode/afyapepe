<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('doctors', function (Blueprint $table) {
      $table->increments('Doc_Id');
      $table->string('user_id')->unique();
      $table->string('Name');
      $table->string('RegDate');
      $table->string('RegNo')->unique();
      $table->string('Address');
      $table->string('Qualifications');
      $table->string('Speciality');
      $table->string('Sub_Speciality');

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('doctors');
    }
}
