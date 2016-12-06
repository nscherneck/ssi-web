<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    public function components() {
      return $this->hasMany('App\Component')->orderBy('model', 'asc');
    }

}
