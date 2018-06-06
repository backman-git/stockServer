<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\lib\stock\StockEloquent;
use App\lib\stock\TwseMiner;
class StockEloquentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevelop()
    {
        $stockEloquent = new StockEloquent(new TwseMiner());
        $stockEloquent->addStock(1101);
        $stockEloquent->addStock(2498);
        $stockEloquent->update();
        $this->assertEquals(1101,$stockEloquent->getLatestStockInfo(1101)->stock_id);
        $this->assertEquals(2498,$stockEloquent->getLatestStockInfo(2498)->stock_id);

        
        $stockEloquent->getLatestStockInfo(2498);




    }
}
