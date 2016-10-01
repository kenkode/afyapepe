<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('gender');
            $table->integer('national_id');
            $table->string('pin');
            $table->date('dob')->nullable();
            $table->integer('age');
            $table->string('mobileno');
            $table->integer('constituency_id')->nullable();
            $table->string('next_kin')->nullable();
            $table->integer('relation_kin')->nullable();
            $table->string('phone_kin')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('current_height')->nullable();
            $table->string('temperature')->nullable();
            $table->string('systolic_bp')->nullable();
            $table->string('diastolic_bp')->nullable();
            $table->integer('allergies')->nullable();
            $table->string('chief_compliant')->nullable();
            $table->string('observation')->nullable();
            $table->string('nurse_note')->nullable();
            $table->string('consulting_physician')->nullable();
            $table->string('prescription')->nullable();
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
        Schema::drop('patients');
    }
}
