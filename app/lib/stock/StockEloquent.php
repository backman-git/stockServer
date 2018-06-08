<?
namespace App\lib\stock;

use App\lib\stock\StockInterface;
use App\model\StockCandidate;
use App\model\StockHistory;
use App\lib\stock\MinerInterface as Miner;
use Illuminate\Support\Facades\Log;
class StockEloquent implements StockInterface{

    protected $miner;

    function __construct(Miner $miner){
        $this->miner= $miner;
    }

    function getStockList(){
        $stocks = StockCandidate::select("stock_id")->get();
        return ($stocks);
    }

    function addStock($stockID){
        $checkStock = StockCandidate::where('stock_id','=',$stockID)->first();
        if ($checkStock===null){
            $stocks = new StockCandidate();
            $stocks->stock_id = $stockID;
            $stocks->save();    
            Log::info($stockID);

        }
    }

    function getLatestStockInfo($stockID){
       return StockHistory::select("stock_id","stockName","prize","highestPrize","lowestPrize","volume","accVolume")->where("stock_id",'=',$stockID)->orderBy('created_at',"dsec")->first();
    }

    function update(){
        //store data into stockHistory
        for($idx=0;$idx<12;$idx+=1){
            $historyData=$this->miner->mine(array_map( function($x){return $x['stock_id']; }  , json_decode(stockCandidate::all(),true)));
            foreach($historyData as $e){
                $stockHistory = new StockHistory();
                $this->latestDataAry[$e->stock_id] = $e;
                foreach($e as $key => $value){
                    $stockHistory->$key =$e->$key;
                }
                $stockHistory->save();
            
            }
            sleep(5);
        }

      

    }


}







?>