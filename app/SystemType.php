<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemType extends Model
{
    public function systems()
    {
        return $this->hasMany('App\System');
    }
}
