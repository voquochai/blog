<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->longText('contents')->nullable();
            $table->json('attributes')->nullable();
            $table->json('meta')->nullable();
            $table->char('language',10)->index();
            $table->integer('post_id')->unsigned();
            $table->unique(['post_id','language']);
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_languages');
    }
}
