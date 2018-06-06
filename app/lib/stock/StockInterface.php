<?
namespace App\lib\stock;


interface StockInterface{

    function getStockList();
    function addStock($stockID);
    function getLatestStockInfo($stockID);

}


?>