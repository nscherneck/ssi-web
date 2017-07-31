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
		$this->customer = create('App\Customer');
		$this->site = create('App\Site', ['customer_id' => $this->customer->id]);
	}

    /** @test */
    public function it_has_a_customer()
    {
        $this->assertInstanceOf(Customer::class, $this->site->customer);
    }

    /** @test */
    public function it_is_assigned_to_a_branch_office()
    {
        $this->assertInstanceOf(BranchOffice::class, $this->site->branchOffice);
    }
}
