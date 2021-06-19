<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            // $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id')->index();
            // $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('unitprice');
            $table->integer('amount');
            $table->integer('discount');
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
        Schema::dropIfExists('order__details');
    }
}
