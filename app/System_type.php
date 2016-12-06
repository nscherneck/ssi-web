<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System_type extends Model
{

  public function systems() {
    return $this->hasMany('App\System');
  }

}
