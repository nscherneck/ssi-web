<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['state'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
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

    /**
     * The attributes to be logged using Spatie laravel-activitylog
     */
    protected static $logAttributes = [
        'notes',
    ];

    /**
    * The "booting" method of Customer
    *
    * @link https://laravel.com/docs/5.4/eloquent#global-scopes Laravel documentation link
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
    *
    * @return  \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function sites()
    {
        return $this->hasMany('App\Site')->orderBy('name', 'asc');
    }

    /**
    * Get the State where this Customer is located (address)
    *
    * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
    * Get the Systems associated with this Customer
    *
    * @return  \Illuminate\Database\Eloquent\Relations\HasManyThrough
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
