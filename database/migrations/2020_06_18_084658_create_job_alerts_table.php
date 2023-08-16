<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->lineString('name')->nullable();
            $table->string('email')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('industry_id')->nullable();
            $table->integer('sending_frequency')->comment('will be set in Days eg. 3,7,10 days')->nullable();
            $table->boolean('is_seeker')->default(0);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_alerts');
    }
}
