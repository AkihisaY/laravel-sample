<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevidendHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devidend_histories', function (Blueprint $table) {
            $table->id();
            $table->date('dividend_date');
            $table->integer('com_id')->unsigned();
            $table->foreign('com_id')->references('com_id')->on('companies');
            $table->double('dividend_amount_jp', 15, 8)->nullable();
            $table->double('dividend_amount_en', 15, 8)->nullable();
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
        Schema::dropIfExists('devidend_histories');
    }
}
