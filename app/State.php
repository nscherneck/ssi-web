<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function sites()
    {
        return $this->hasMany('App\Site');
    }

    public function manufacturers()
    {
        return $this->hasMany('App\Manufacturer');
    }
    
}
