<?php

namespace Tests\Unit;

use App\Site;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SystemTest extends TestCase
{

	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();
		$this->site = create('App\Site');
        $this->system = create('App\System', ['site_id' => $this->site->id]);
        $this->component = create('App\Component');
	}

    /** @test */
    public function it_belongs_to_a_site()
    {
        $this->assertInstanceOf(Site::class, $this->system->site);
    }

    /** @test */
    public function it_can_have_a_component_attached()
    {
        $this->system->attachComponent($this->component->id, 5, 'Lorem ipsum');
        $this->assertEquals(5, $this->system->sumComponents());
    }

    /** @test */
    public function it_can_have_a_component_detached()
    {
        $this->system->detachComponent($this->component->id);
        $this->assertEquals(0, $this->system->sumComponents());
    }

}
