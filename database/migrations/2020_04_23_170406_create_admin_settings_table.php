<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('public_logo')->nullable();
            $table->string('website_title')->nullable();
            $table->string('google_translator')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('addrees')->nullable();
            $table->string('about')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('currency')->nullable();
            $table->string('symbol')->nullable();
            $table->integer('single_job_price')->nullable();
            $table->integer('single_job_expiry_days')->nullable();
            $table->string('google_api_key')->nullable();
            $table->longText('google_analytics')->nullable();
            $table->longText('google_adsense')->nullable();
            $table->string('android')->nullable();
            $table->string('apple')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('tumbler')->nullable();
            $table->string('instgram')->nullable();
            $table->string('paypal_key')->nullable();
            $table->string('paypal_secret')->nullable();
            $table->string('stripe_key')->nullable();
            $table->string('stripe_secret')->nullable();
            $table->longText('external_jobs_apis')->nullable();
            $table->integer('tax')->comment('tax will apply in percenatge on packages')->nullable();
            $table->string('tax_unit')->comment('this is unit of tax e.g vat,gst depend on country')->nullable();
            $table->float('seeker_upgrade_price')->nullable();
            $table->integer('recruiter_cv_purchase_price')->nullable();
            $table->integer('recruiter_cv_purchase_days')->nullable();
            $table->integer('daily_limit_cv_download')->nullable();
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
        Schema::dropIfExists('admin_settings');
    }
}
