<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_jobs')->nullable();
            $table->string('average_salary')->nullable();
            $table->integer('total_alerts')->nullable();
            $table->integer('total_seekers')->nullable();
            $table->integer('total_recruiters')->nullable();
            $table->integer('total_skills')->nullable();
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
        Schema::dropIfExists('web_stats');
    }
}
