<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditWorkOrdersTest extends TestCase
{

	use DatabaseMigrations;

    /** @test */
    public function a_user_can_edit_a_work_order()
    {
    	$this->signIn();

    	$workOrder = make('App\WorkOrder');

    	$this->get('/workorders/edit/{$workOrder->id}')
    	    ->assertResponse([], 200);
    }	

}