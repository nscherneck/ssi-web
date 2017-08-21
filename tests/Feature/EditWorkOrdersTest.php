<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditWorkOrdersTest extends TestCase
{
    use DatabaseMigrations;

    public function a_user_can_edit_a_work_order()
    {
        $this->signIn();

        $workOrder = make('App\WorkOrder');

        $this->get('/workorders/edit/{$workOrder->id}')
            ->assertResponse([], 200);
    }
}
