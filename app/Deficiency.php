<?php
namespace App;

use App\Test;
use Illuminate\Database\Eloquent\Model;

class Deficiency extends Model
{

    public function test()
    {
        return $this->belongsTo('App\Test');
    }

    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

}
