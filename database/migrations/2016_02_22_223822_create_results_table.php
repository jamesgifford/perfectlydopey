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
            $table->string('5k_time', 10);
            $table->string('10k_time', 10);
            $table->string('half_time', 10);
            $table->string('full_time', 10);
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
