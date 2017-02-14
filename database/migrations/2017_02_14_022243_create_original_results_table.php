<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriginalResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('original_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('runner_id')->unsigned()->index();
            $table->integer('year')->unsigned();
            $table->string('full_name', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->integer('age')->unsigned();
            $table->string('gender', 2);
            $table->string('5k_time', 20);
            $table->string('10k_time', 20);
            $table->string('half_time', 20);
            $table->string('full_time', 20);
            $table->string('location', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('country', 50);
            $table->timestamps();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('original_results');
    }
}
