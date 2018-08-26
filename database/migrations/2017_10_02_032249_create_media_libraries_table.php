<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('alt')->nullable();
            $table->string('link')->nullable();
            $table->integer('size')->default(0);
            $table->json('editor')->nullable();
            $table->smallInteger('priority')->default(1);
            $table->string('status',100)->default('publish');
            $table->char('mime_type',50)->nullable();
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
        Schema::dropIfExists('media_libraries');
    }
}
