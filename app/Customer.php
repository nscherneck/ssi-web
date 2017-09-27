<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    protected $with = ['state'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'slug',
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
        'updated_at',
    ];

    protected static $logAttributes = [
        'notes',
    ];

    /**
    * The "booting" method of Customer
    *
    * @return void
    */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('siteCount', function ($builder) {
            $builder->withCount('sites');
        });

        static::addGlobalScope('systemsCount', function ($builder) {
            $builder->withCount('systems');
        });
    }

    /**
    * Get the Sites associated with this Customer
    */
    public function sites()
    {
        return $this->hasMany('App\Site')->orderBy('name', 'asc');
    }

    /**
    * Get the State where this Customer is located (address)
    */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
    * Get the Systems associated with this Customer
    */
    public function systems()
    {
        return $this->hasManyThrough('App\System', 'App\Site');
    }

    /**
    * Get the url path associated with this Customer
    */
    public function path()
    {
        return '/customers/' . $this->id;
    }
}
