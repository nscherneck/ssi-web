<?php
namespace App;

use DB;
use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Site extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    protected $with = ['state', 'customer'];

    protected $dates = [
        'created_at',
        'updated_at'
        ];

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

    protected static $logAttributes = [
        'notes'
        ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function systems()
    {
        return $this->hasMany('App\System')
        ->orderBy('name', 'asc');
    }

    public function systemTypes()
    {
        return $this->hasManyThrough('App\SystemType', 'App\System');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function branchOffice()
    {
        return $this->belongsTo('App\BranchOffice');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    public function path()
    {
        return '/sites/' . $this->id;
    }

    public function distanceCalculator($originLatitude, $originLongitude)
    {
        $mode = 'car';
        $language = 'en-EN';
        $units = 'imperial';
        $distanceApiCall = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$originLatitude},{$originLongitude}&destinations={$this->lat},{$this->lon}&mode={$mode}&language={$language}&units={$units}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $distanceApiCall);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $returnedJson = json_decode(curl_exec($ch), true);
        $distanceInMeters = $returnedJson['rows'][0]['elements'][0]['distance']['value'];
        $distanceInMiles = $distanceInMeters / 1609.344;
        return number_format($distanceInMiles, 1);
    }

    public function durationCalculator($originLatitude, $originLongitude)
    {
        $mode = 'car';
        $language = 'en-EN';
        $units = 'imperial';
        $distanceApiCall = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$originLatitude},{$originLongitude}&destinations={$this->lat},{$this->lon}&mode={$mode}&language={$language}&units={$units}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $distanceApiCall);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $returnedJson = json_decode(curl_exec($ch), true);
        $duration = $returnedJson['rows'][0]['elements'][0]['duration']['text'];
        return $duration;
    }
}
