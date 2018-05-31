<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Stocks', function (Blueprint $table) {
            $table->string('stock_id');
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
        Schema::dropIfExists('Stocks');
    }
}
