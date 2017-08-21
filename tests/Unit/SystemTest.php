<?php

namespace Tests\Unit;

use App\Site;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
    public function it_has_a_next_test_date()
    {
        $now = Carbon::now()->setTimezone('America/Los_Angeles');
        $this->system->setNextTestDate($now);
        $this->assertEquals(
            Carbon::now()->setTimezone('America/Los_Angeles')->addYear()->format('Y-m-d'),
            $this->system->next_test_date->format('Y-m-d')
        );
    }

    /** @test */
    public function it_has_a_properly_formatted_path()
    {
        $this->assertEquals("/systems/{$this->system->id}", $this->system->path());
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

    /** @test */
    public function it_can_have_a_new_test_added()
    {
    }
}
