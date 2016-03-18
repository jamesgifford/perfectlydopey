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
            $table->integer('runner_id')->unsigned()->index();
            $table->integer('year')->unsigned();
            $table->string('full_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->integer('age')->unsigned();
            $table->string('gender', 2);
            $table->time('5k_time', 10);
            $table->time('10k_time', 10);
            $table->time('half_time', 10);
            $table->time('full_time', 10);
            $table->string('location', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->timestamps();
            $table->unique(['year', 'full_name', 'age', '5k_time', 'location']);
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
