<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    public function tests()
    {
        return $this->hasMany('App\Test');
    }
}
