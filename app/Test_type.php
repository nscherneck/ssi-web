<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_type extends Model
{

    public function tests()
    {
      return $this->hasMany('App\Test');
    }

}
