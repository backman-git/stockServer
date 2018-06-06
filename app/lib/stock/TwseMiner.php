<?php
namespace App\lib\stock;

use App\lib\stock\MinerInterface;
use Illuminate\Support\Facades\Log;

class TwseMiner implements MinerInterface{
    var $endPoint;
    var $driver;
    function __construct(){
        $this->driver = new \GuzzleHttp\Client(['base_uri' =>'http://mis.twse.com.tw','cookies' => true]);
        #get session
        $tmp=$this->driver->request('GET',"/stock/fibest.jsp");
    }

  

    private function formatRequest($stockNumber){
        $currentEpochTime = round(microtime(true) * 1000);
        return "/stock/api/getStockInfo.jsp?ex_ch=tse_$stockNumber.tw&json=1&delay=0&_=$currentEpochTime";
    }

    function mine($stockList){
        
        $dataAry=array();
        foreach($stockList as $stock){
            #should dispath as a job!
            #get json data
            $response = $this->driver->request('GET',$this->formatRequest($stock));
            $resJson=json_decode($response->getBody());
            $dataObj=($resJson->msgArray)[0];
            $dataAry[] =(object)[   "stock_id" => $dataObj->c,
                            "prize" => $dataObj->z,
                            "highestPrize" => $dataObj->h, 
                            "lowestPrize" => $dataObj->l,
                            "volume" => $dataObj->tv,
                            "accVolume" => $dataObj->v,
                            "stockName" => $dataObj->nf
                        ];
        }
        Log::info($dataAry);
        return $dataAry;
    }


}
/*
    $stockDBObj = 
            $stockDBObj->stock_id = $info->c;
            $stockDBObj->prize = $info->z;
            $stockDBObj->highestPrize = $info->h;
            $stockDBObj->lowestPrize = $info->l;
            $stockDBObj->volume = $info->tv;
            $stockDBObj->accVolume = $info->v;
            $stockDBObj->stockName = $info->nf;
            $stockDBObj->save();
*/