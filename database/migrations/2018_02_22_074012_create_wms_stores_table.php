<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWmsStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code',50)->unique();
            $table->string('name',100)->nullable();
            $table->char('phone',20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('priority')->default(1);
            $table->string('status',100)->default('publish');
            $table->char('type',50)->default('default');
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
        Schema::dropIfExists('wms_stores');
    }
}
