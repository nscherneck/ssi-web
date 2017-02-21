<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class ExampleTest extends TestCase
{

  public function userCanVisitInstallationPage()
  {
      $user = new User([
        'id' => 1
      ]);

      $this->be($user);

      $this->visit('/installation')
           ->see('Installation Page');
  }

  /** @test */
 public function userCanVisitHomePage()
  {
      $user = new User([
        'id' => 1
      ]);

      $this->be($user);

      $this->visit('/sales')
           ->see('Sales Page');
  }


}
