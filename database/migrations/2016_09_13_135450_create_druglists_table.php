<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDruglistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('druglists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id');
            $table->string('drugname');
            $table->string('regno');
            $table->string('dosageform');
            $table->string('ingredients');
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
        Schema::drop('druglists');
    }
}
