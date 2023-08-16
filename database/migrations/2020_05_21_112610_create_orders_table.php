<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_type')->nullable();
            $table->string('order_title')->nullable();
            $table->text('billing_info');
            $table->integer('recruiter_id');
            $table->bigInteger('job_id')->nullable();
            $table->string('currency');
            $table->integer('price_of_job')->nullable();
            $table->integer('tax_amount');
            $table->integer('tax_percentage');
            $table->integer('total_amount');
            $table->text('stripe_response')->nullable();
            $table->text('coupon_applied')->nullable();
            $table->text('coupon_detail')->nullable();
            $table->string('payment_status')->comment("pending,completed");
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
        Schema::dropIfExists('orders');
    }
}
