<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seekers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('profile_complete')->nullable();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('postcode')->nullable();
            $table->string('current_job_title')->nullable();
            $table->string('current_company')->nullable();
            $table->string('skills')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->integer('expected_salary')->nullable();
            $table->date('dateavailable')->nullable();
            $table->string('available_job_type')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('industries')->nullable();
            $table->string('cv_resume')->nullable();
            $table->integer('relocate')->default(0);
            $table->integer('reg_step')->default(1);
            $table->integer('is_social_login')->default(0);
            $table->string('social_login_id')->nullable();
            $table->string('social_channel')->nullable();
            $table->integer('is_blocked')->default(0);
            $table->date('email_verified_at')->nullable();
            $table->string('confirm_email_random_id')->nullable();
            $table->text('social_token')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('degree_level')->nullable();
            $table->string('career_level')->nullable();
            $table->string('website_portfolio')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('facebook_profile')->nullable();
            $table->longText('twitter_profile')->nullable();
            $table->longText('linkdin_profile')->nullable();
            $table->longText('github_profile')->nullable();
            $table->longText('hobbies')->nullable();
            $table->longText('languages')->nullable();
            $table->integer('seeking_job')->default(0)->nullable();
            $table->integer('is_upgraded')->default(0)->nullable();
            $table->dateTime('expiry_upgrade')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('seekers');
    }
}
