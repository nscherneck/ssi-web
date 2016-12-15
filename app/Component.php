<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

  protected $hidden = ['created_at', 'updated_at'];

  public function systems() {
    return $this->belongsToMany('App\System', 'components_systems', 'component_id', 'system_id')->withPivot('quantity', 'name', 'id');
  }

  public function component_category() {
    return $this->belongsTo('App\Component_category');
  }

  public function manufacturer() {
    return $this->belongsTo('App\Manufacturer')->orderBy('name', 'asc');
  }


}
