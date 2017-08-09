<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Testnote extends Model
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
