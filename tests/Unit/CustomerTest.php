<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->customer = create('App\Customer');
        $this->site = create('App\Site', ['customer_id' => $this->customer->id]);
    }

    /** @test */
    public function it_has_sites()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->customer->sites);
    }

    /** @test */
    public function it_was_added_by_a_user()
    {
        $this->assertInstanceOf('App\User', $this->customer->addedBy);
    }
}
