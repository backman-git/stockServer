<?
namespace App\lib\stock;

use App\lib\stock\StockInterface;
use App\model\StockCandidate;
use App\model\StockHistory;
use App\lib\stock\MinerInterface as Miner;
use Illuminate\Support\Facades\Log;
class StockEloquent implements StockInterface{

    protected $miner;
    protected $latestDataAry;

    function __construct(Miner $miner){
        $this->miner= $miner;
        $this->latestDataAry =array();
        $stockCandidates = stockCandidate::all();
    }

    function getStockList(){
        $stocks = StockCandidate::select("stock_id")->get();
        return ($stocks);
    }

    function addStock($stockID){
        $checkStock = StockCandidate::where('stock_id','=',$stockID)->first();
        if ($checkStock==null){
            $stocks = new StockCandidate();
            $stocks->stock_id = $stockID;
            $stocks->save();    
        }
        
    }

    function getLatestStockInfo($stockID){
        return $this->latestDataAry[$stockID];
    }

    function update(){
        //store data into stockHistory
        $historyData=$this->miner->mine(array_map( function($x){return $x['stock_id']; }  , json_decode(stockCandidate::all(),true)));
        foreach($historyData as $e){
            $stockHistory = new StockHistory();
            $this->latestDataAry[$e->stock_id] = $e;
            foreach($e as $key => $value){
                $stockHistory->$key =$e->$key;
            }
            $stockHistory->save();

        }

      

    }


}







?>