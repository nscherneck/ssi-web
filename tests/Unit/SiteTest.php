<?php

namespace Tests\Unit;

use App\Customer;
use App\BranchOffice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->site = create('App\Site');
        $this->system = create('App\System', ['site_id' => $this->site->id]);
	}

    /** @test */
    public function it_belongs_to_a_customer()
    {
        $this->assertInstanceOf(Customer::class, $this->site->customer);
    }

    /** @test */
    public function it_has_a_system()
    {
        $this->assertEquals(1, $this->site->systems->count());
    }
    
    /** @test */
    public function it_is_assigned_to_a_branch_office()
    {
        $this->assertInstanceOf(BranchOffice::class, $this->site->branchOffice);
    }

}
