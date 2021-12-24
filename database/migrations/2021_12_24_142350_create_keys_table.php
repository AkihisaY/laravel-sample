<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id('key_id');
            $table->string('project_key',10);
            $table->text('project_name');
            $table->string('delete_flg', 1)->nullable()->comment('1:delete');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('logins');
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
        Schema::dropIfExists('keys');
    }
}
