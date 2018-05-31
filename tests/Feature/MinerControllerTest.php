<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\MinerController;

trait ConsoleOutput {
 
    /**
     * Show console output.
     *
     * @param  string  $text
     *
     * @return void;
     */
    public function dump($text)
    {
        fwrite(STDERR, var_dump($text)."\n");
    }
    public function show($text){
        fwrite(STDERR, print $text."\n");
    }
    public function showJson($text){
        fwrite(STDERR, var_dump(json_decode($text,true))."\n" );
    }
}


class MinerControllerTest extends TestCase
{
    use ConsoleOutput;

    public function testDevelop(){
        $m = new MinerController();
        $m->addStock(1101);
        $m->addStock(2498);
        $m->mine();
        #$m->mine();
       

        #$this->show($m->mine());
    
        

    }
}
