<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiJobsPagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_jobs_pagings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jobs_from')->nullable();
            $table->integer('current_page')->nullable();
            $table->integer('total_pages')->nullable();
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
        Schema::dropIfExists('api_jobs_pagings');
    }
}
