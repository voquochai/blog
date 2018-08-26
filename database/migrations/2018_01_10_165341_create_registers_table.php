<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->char('phone',20)->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('district_id')->default(0);
            $table->tinyInteger('province_id')->default(0);
            $table->tinyInteger('gender')->default(0);
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->longText('contents')->nullable();
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
        Schema::dropIfExists('registers');
    }
}
