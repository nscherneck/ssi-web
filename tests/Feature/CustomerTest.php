<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_customers()
    {
    	$user = factory('App\User')->create();
        $customer = factory('App\Customer')->create();

        $response = $this->actingAs($user)->get('/customers');

        $response->assertSee($customer->name);
    }
}
