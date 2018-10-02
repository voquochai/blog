<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('slug');
            $table->text('description')->nullable();
            $table->longText('contents')->nullable();
            $table->json('meta')->nullable();
            $table->char('language',10)->index();
            $table->integer('category_id')->unsigned();
            $table->unique(['category_id','language']);
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_languages');
    }
}
