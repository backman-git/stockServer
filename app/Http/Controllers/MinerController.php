<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;

class MinerController extends Controller{
    var $endPoint;
    var $driver;
    var $stockList;
    function __construct(){
        $this->driver = new \GuzzleHttp\Client(['base_uri' =>'http://mis.twse.com.tw','cookies' => true]);
        #get session
        $tmp=$this->driver->request('GET',"/stock/index.jsp");
        $this->stockList = array();
    }

    function addStock($stockNumber){
        $this->stockList[] = $stockNumber;
    }
    

    function formatRequest($stockNumber){
        $currentEpochTime = round(microtime(true) * 1000);
        return "/stock/api/getStockInfo.jsp?ex_ch=tse_$stockNumber.tw&json=1&delay=0&_=$currentEpochTime";
    }

    function mine(){
        #may be fun !  modify it!
        foreach($this->stockList as $stock){
            #should dispath as a job!
            #get json data
            $res = $this->driver->request('GET',$this->formatRequest($stock));
            $resJson=json_decode($res->getBody());
            #store to database
            $info = ($resJson->msgArray)[0];
            $s = new Stock();
            $s->stock_id = $info->c;
            $s->prize = $info->z;
            $s->highestPrize = $info->h;
            $s->lowestPrize = $info->l;
            $s->volume = $info->tv;
            $s->accVolume = $info->v;
            $s->save();
        }
    }


}
