<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->char('product_code',50);
            $table->string('product_name')->nullable();
            $table->smallInteger('product_qty')->default(0);
            $table->double('product_price')->default(0);
            $table->integer('size_id')->default(0);
            $table->string('size_name')->nullable();
            $table->integer('color_id')->default(0);
            $table->string('color_name')->nullable();
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status',100)->default('publish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
