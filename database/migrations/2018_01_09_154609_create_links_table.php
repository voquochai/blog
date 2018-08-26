<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->char('phone',20)->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype',100)->nullable();
            $table->string('youtube',100)->nullable();
            $table->char('icon',50)->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('alt')->nullable();
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
        Schema::dropIfExists('links');
    }
}
