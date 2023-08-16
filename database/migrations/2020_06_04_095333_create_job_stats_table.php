<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id')->unsigned()->index();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->integer('views');
            $table->string('ip_address')->index();
            $table->string('browser')->index();
            $table->string('platform')->index();
            $table->string('visits')->index();
            $table->string('country')->index();
            $table->string('city')->index();
            $table->string('lat')->index();
            $table->string('lon')->index();
            $table->string('timezone')->index();
            $table->string('isp')->index();
            $table->string('region')->index();
            $table->string('regionname')->index();
            $table->string('countrycode')->index();
            $table->string('zip')->index();
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
        Schema::dropIfExists('job_stats');
    }
}
