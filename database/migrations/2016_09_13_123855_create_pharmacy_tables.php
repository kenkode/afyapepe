<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pharmacy', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('county_id');
          $table->string('town');
          $table->string('street');
          $table->integer('pharmacy_code');
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
        Schema::drop('pharmacy');
    }
}
