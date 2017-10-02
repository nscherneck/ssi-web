<?php
namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Site extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'state',
        'customer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable =  [
        'name',
        'slug',
        'address1',
        'address2',
        'city',
        'state_id',
        'zip',
        'branch_office_id',
        'lat',
        'lon',
        'phone',
        'fax',
        'notes',
        'added_by',
        'updated_by',
        'updated_at'
    ];

    /**
     * The attributes to be logged using Spatie laravel-activitylog
     */
    protected static $logAttributes = [
        'notes'
        ];

    /**
    * Get the Customer that this Site belongs to
    */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
    * Get the Systems associated with this Site
    */
    public function systems()
    {
        return $this->hasMany('App\System')
        ->orderBy('name', 'asc');
    }

    /**
     * Get all the system types associated with this Site
     */
    public function systemTypes()
    {
        return $this->hasManyThrough('App\SystemType', 'App\System');
    }

    /**
     * Get the State where this Site is located (address)
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
    * Get the Branch Office that this Site belongs to
    */
    public function branchOffice()
    {
        return $this->belongsTo('App\BranchOffice');
    }

    /**
    * Get the url path associated with this Site
    */
    public function path()
    {
        return '/sites/' . $this->id;
    }

    /**
     * Calculates distance or duration from the Site based on the provided origin coordinates (branch office location)
     * @param  String $originLatitude  Latitude for the origination point
     * @param  String $originLongitude Longitude for the origination point
     * @param  String $type            Type of data desired (Distance or Duration)
     * @return String                  Distance or duration, based on the data desired
     */
    public function travelCalculator($originLatitude, $originLongitude, $type)
    {
        $mode = 'car';
        $language = 'en-EN';
        $units = 'imperial';
        $key = config('services.google_maps.key');
        $distanceApiCall = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$originLatitude},{$originLongitude}&destinations={$this->lat},{$this->lon}&mode={$mode}&language={$language}&units={$units}&key={$key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $distanceApiCall);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $returnedJson = json_decode(curl_exec($ch), true);
        if (!empty($returnedJson) && $type == 'distance') {
            $distanceInMeters = $returnedJson['rows'][0]['elements'][0]['distance']['value'];
            $distanceInMiles = $distanceInMeters / 1609.344;
            return number_format($distanceInMiles, 1);
        }
        if (!empty($returnedJson) && $type == 'duration') {
            return $returnedJson['rows'][0]['elements'][0]['duration']['text'];
        }
        return 'error';
    }
}
