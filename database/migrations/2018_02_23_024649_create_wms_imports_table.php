<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWmsImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wms_imports', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code',50)->unique();
            $table->char('store_code',50)->nullable();
            $table->smallInteger('import_qty')->default(0);
            $table->double('import_price')->default(0);
            $table->string('note_cancel')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->smallInteger('priority')->default(1);
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
        Schema::dropIfExists('wms_imports');
    }
}
