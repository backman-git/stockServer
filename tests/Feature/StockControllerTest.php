<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class StockControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $res=$this->get('api/stocks');
        $res->assertStatus(200);
    }

    public function testStore(){
        $res= $this->post('api/stocks',["stockID"=>2317]);
        $res->assertStatus(201)
            ->assertJson(["addStatus"=>true]);
    }


}
