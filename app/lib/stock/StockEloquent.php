<?
namespace App\lib\stock;

use App\lib\stock\StockInterface;
use App\Model\Stock;


class StockEloquent implements StockInterface{

    function getStockList(){
        $stocks = Stock::select('stock_id','stockName')->get();
        return $stocks;
    }

}






?>