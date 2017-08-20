<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{
    public $timestamps = false;
    protected $table = "component_category";

    public function components()
    {
        return $this->hasMany('App\Component');
    }
}
