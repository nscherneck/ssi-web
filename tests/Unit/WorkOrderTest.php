<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkOrderTest extends TestCase
{

	use DatabaseMigrations;

    /** @test */
    public function it_belongs_to_a_site()
    {
    	$workOrder = create('App\WorkOrder');

    	$this->assertInstanceOf('App\Site', $workOrder->site);
    }	

    /** @test */
    public function its_assigned_to_a_technician()
    {
    	$workOrder = create('App\WorkOrder');

    	$this->assertInstanceOf('App\User', $workOrder->assignedTechnician);
    }		

    /** @test */
    public function it_was_created_by_a_user()
    {
    	$workOrder = create('App\WorkOrder');

    	$this->assertInstanceOf('App\User', $workOrder->createdBy);
    }	

    /** @test */
    public function it_has_a_status()
    {
    	$workOrder = create('App\WorkOrder');

    	$this->assertInstanceOf('App\WorkOrderStatus', $workOrder->status);
    }	

    /** @test */
    public function it_has_a_type()
    {
    	$workOrder = create('App\WorkOrder');

    	$this->assertInstanceOf('App\WorkOrderType', $workOrder->type);
    }   

    /** @test */
    public function it_has_a_billing_status()
    {
        $workOrder = create('App\WorkOrder');

        $this->assertInstanceOf('App\WorkOrderBillingStatus', $workOrder->billingStatus);
    }	    

}
