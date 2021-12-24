<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->integer('com_id')->unsigned();
            $table->foreign('com_id')->references('com_id')->on('companies');
            $table->integer('stock_cnt')->nullable();
            $table->double('amount_en', 15, 8)->nullable();
            $table->double('amount_jp', 15, 8)->nullable();
            $table->double('amount_en_per', 15, 8)->nullable();
            $table->double('amount_jp_per', 15, 8)->nullable();
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
        Schema::dropIfExists('stock_histories');
    }
}
