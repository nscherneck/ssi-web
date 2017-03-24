<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{

    use LogsActivity;

    protected $dates = [
        'created_at', 
        'updated_at'
        ];

    protected $fillable = [
        'name', 
        'address1', 
        'address2', 
        'address3', 
        'city', 
        'state_id', 
        'zip', 
        'phone', 
        'fax', 
        'web', 
        'email', 
        'notes', 
        'added_by', 
        'updated_by', 
        'updated_at'
        ];

    protected static $logAttributes = [
        'notes'
        ];

    public function sites() 
    {
        return $this->hasMany('App\Site')->orderBy('name', 'asc');
    }

    public function state() 
    {
        return $this->belongsTo('App\State');
    }

    public function systems() 
    {
        return $this->hasManyThrough('App\System', 'App\Site');
    }

    public function addedBy() // technician who completed test
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function updatedBy() // technician who completed test
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }

}
