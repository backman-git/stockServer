<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\lib\stock\TwseMiner;
class TwseMinerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevelop()
    {
        $m = new TwseMiner();
        $ary=$m->mine([1101,2498]);
        $this->assertEquals(1101,$ary[0]->stock_id);
        $this->assertEquals(2498,$ary[1]->stock_id);

    }
}
