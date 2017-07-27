<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    public function components() 
    {
        return $this->hasMany('App\Component')->orderBy('model', 'asc');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function addedBy() // technician who completed test
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function updatedBy() // technician who completed test
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function path()
    {
        return '/manufacturer/' . $this->id;
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }

}
