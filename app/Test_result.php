<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_result extends Model
{

    public function tests()
    {
      return $this->hasMany('App\Test');
    }
    
}
