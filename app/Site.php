<?php
namespace App;

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
