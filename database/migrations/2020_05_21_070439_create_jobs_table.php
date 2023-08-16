<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->integer('city')->nullable();
            $table->integer('job_industry')->nullable();
            $table->string('skills')->nullable();
            $table->string('contract_type')->comment('permanent,contract,training,temporary,volutary');
            $table->string('time_available')->comment('eg. Full Time, Part Time');
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->string('salary_schedule')->comment('salary is (weekly, monthly, yearly , hourly)');
            $table->integer('is_payment_done')->default(0);
            $table->string('unique_string')->nullable();
            $table->string('job_status')->nullable();
            $table->string('job_reject_reason')->nullable();
            $table->bigInteger('views')->nullable();
            $table->integer('has_coupon')->default(0);
            $table->date('expiry_date')->nullable();
            $table->string('postcode_string')->nullable();
            $table->text('logo_string')->nullable();
            $table->text('snippet')->nullable();
            $table->integer('age_days')->comment('ago')->nullable();
            $table->string('location_string')->nullable();
            $table->string('salary_string')->nullable();
            $table->string('company')->nullable();
            $table->text('addition_params')->nullable();
            $table->string('job_id_string')->nullable();
            $table->string('job_website')->nullable();
            $table->string('category_string')->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
