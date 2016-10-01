<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatienttestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patienttests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('test_id');
            $table->string('notes');
            $table->integer('facility_code');
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
        Schema::drop('patienttests');
    }
}
