<?php
namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use CreatedUpdatedInfo;

    /**
    * Get the Components associated with this Manufacturer
    *
    * @link Component@manufacturer.php
    */
    public function components()
    {
        return $this->hasMany('App\Component')->orderBy('model', 'asc');
    }

    /**
    * Get the state where this Manufacturer is located (address)
    */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
    * Get the url path associated with this Manufacturer
    */
    public function path()
    {
        return '/manufacturer/' . $this->id;
    }
}
