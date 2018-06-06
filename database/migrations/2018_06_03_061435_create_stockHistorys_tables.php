<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockHistorysTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockHistorys', function (Blueprint $table) {
            $table->unsignedInteger('stock_id');
            $table->string('stockName');
            $table->float("prize",6,2);
            $table->float("highestPrize",6,2);
            $table->float("lowestPrize",6,2);
            $table->unsignedInteger('volume');
            $table->unsignedInteger('accVolume');
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
        Schema::dropIfExists('StockHistorys');
    }
}
