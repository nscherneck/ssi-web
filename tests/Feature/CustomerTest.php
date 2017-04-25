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
        $customer = factory('App\Customer')->create();

        $response = $this->get('/customers');

        $response->assertSee($customer->name);
    }
}
