<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 50);
            $table->integer('age')->unsigned();
            $table->string('gender', 2);
            $table->string('5k', 10);
            $table->string('10k', 10);
            $table->string('half', 10);
            $table->string('full', 10);
            $table->string('location', 50);
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
        Schema::drop('results');
    }
}
