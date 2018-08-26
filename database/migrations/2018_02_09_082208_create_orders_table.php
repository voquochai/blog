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
            $table->increments('id');
            $table->char('code',50)->unique();
            $table->string('coupon_code',50)->nullable();
            $table->integer('coupon_amount')->default(0);
            $table->integer('shipping')->default(0);
            $table->double('subtotal')->default(0);
            $table->smallInteger('order_qty')->default(0);
            $table->double('order_price')->default(0);
            $table->string('name',100)->nullable();
            $table->char('phone',20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('district_id')->default(0);
            $table->tinyInteger('province_id')->default(0);
            $table->tinyInteger('payment_id')->default(0);
            $table->integer('member_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->tinyInteger('status_id')->default(1);
            $table->integer('priority')->default(1);
            $table->string('status',100)->default('publish');
            $table->char('type',50)->default('default');
            $table->softDeletes()->nullable();
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
