<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_jobs')->nullable()->default(0);
            $table->integer('parent')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_url')->nullable();
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_size')->nullable();
            $table->string('creator_name')->nullable();
            $table->string('creator_position')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('industry')->nullable();
            $table->text('company_description')->nullable();
            $table->integer('is_social_login')->default(0);
            $table->string('social_login_id')->nullable();
            $table->string('social_channel')->nullable();
            $table->integer('is_blocked')->default(0);
            $table->date('email_verified_at')->nullable();
            $table->string('confirm_email_random_id')->nullable();
            $table->text('social_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('billing_details')->nullable();
            $table->date('cv_purchased_validity')->nullable();
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
        Schema::dropIfExists('recruiters');
    }
}
