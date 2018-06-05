<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait ConsoleOutput {
 
    /**
     * Show console output.
     *
     * @param  string  $text
     *
     * @return void;
     */
    public function show($text)
    {
        fwrite(STDERR, $text."\n");
    }
}

class StockControllerTest extends TestCase
{   
    use ConsoleOutput;
  
    public function testDevelop(){

        $res=$this->get('stocks');
        $this->show($res->getContent());
        #$this->assertEquals('{s_id}',$res->getContent());
        $res->assertStatus(200);
    }
    
}
