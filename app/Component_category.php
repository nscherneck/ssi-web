<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Component_category extends Model
{

    protected $table = "component_category";

    public function components() 
    {
        return $this->hasMany('App\Component');
    }

    public function get_category() 
    {
        $types = DB::table('component_category')->pluck('id', 'name');
        return $types;
    }

}
