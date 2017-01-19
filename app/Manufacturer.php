<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    public function components() {
      return $this->hasMany('App\Component')->orderBy('model', 'asc');
    }

    public function state()
    {
      return $this->belongsTo('App\State');
    }

    public function addedBy() // technician who completed test
    {
      return $this->belongsTo('App\User', 'added_by');
    }

    public function updatedBy() // technician who completed test
    {
      return $this->belongsTo('App\User', 'updated_by');
    }

}
