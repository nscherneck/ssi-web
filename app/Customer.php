<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{

    protected $fillable = ['name', 'address1', 'address2', 'address3', 'city', 'state_id', 'zip', 'phone', 'fax', 'web', 'email', 'notes', 'updated_at'];

    public function sites() {
    return $this->hasMany('App\Site')->orderBy('name', 'asc');
  }

    public function state() {
    return $this->belongsTo('App\State');
  }

  public function count_sites($id) {
    $site_quantity = DB::table('sites')->where('customer_id', $id)->count();
    return $site_quantity;
  }

  public function systems() {
      return $this->hasManyThrough('App\System', 'App\Site');
  }


}
