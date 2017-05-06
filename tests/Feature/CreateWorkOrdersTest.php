<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateWorkOrdersTest extends TestCase
{

	use DatabaseMigrations;

    /** @test */
    public function guests_cannot_create_a_work_order()
    {
        $this->withExceptionHandling();

        $this->get('/workorders/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_work_order()
    {
        $this->signIn();

        $workOrder = make('App\WorkOrder');

        $response = $this->post('/workorders', $workOrder->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($workOrder->title)
            ->assertSee($workOrder->scope_of_work);
    }

    /** @test */
    public function a_work_order_requires_a_title()
    {
        $this->createWorkOrder(['title' => null])
            ->assertSessionHasErrors('title');

        $this->createWorkOrder(['scope_of_work' => null])
            ->assertSessionHasErrors('scope_of_work');
    }

    public function createWorkOrder($overrides = [])
    {
    	$this->withExceptionHandling()->signIn();

    	$workOrder = make('App\WorkOrder', $overrides);

    	return $this->post('/workorders', $workOrder->toArray());
    }

    /** @test */
    public function an_authenticated_user_can_view_all_work_orders()
    {
    	$workOrder = create('App\WorkOrder');

        $this->signIn()->get('/workorders')
            ->assertSee($workOrder->title);
    }
}
