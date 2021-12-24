<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id('asset_id');
            $table->date('target_date')->nullable();
            $table->double('cash_jpy', 15, 8)->nullable();
            $table->double('cash_usd', 15, 8)->nullable();
            $table->double('cash_inv_jpy', 15, 8)->nullable();
            $table->double('cash_inv_usd', 15, 8)->nullable();
            $table->double('stock_us', 15, 8)->nullable();
            $table->double('stock_other', 15, 8)->nullable();
            $table->string('delete_flg', 1)->nullable()->comment('1:delete');
            
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
        Schema::dropIfExists('assets');
    }
}
