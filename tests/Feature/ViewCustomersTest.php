<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewCustomersTest extends TestCase
{

    use DatabaseMigrations;

    protected $customer;

    public function setUp()
    {
    	parent::setUp();
        $this->customer = create(\App\Customer::class);
    }

    /** @test */
    public function a_user_can_browse_all_customers()
    {
        $this->signIn();

        $this->get('/customers')
            ->assertSee($this->customer->name);
    }

    /** @test */
    public function a_user_can_view_a_customer_record()
    {
        $this->signIn()->get('/customer/' . $this->customer->id)
            ->assertSee($this->customer->name);
    }

    /** @test */
    public function a_user_can_see_new_customer_activity_item_on_home_page()
    {
        $this->signIn()->get('/')
            ->assertSee($this->customer->name);
    }

}
