<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Site extends Model
{

    protected $dates = ['created_at', 'updated_at'];
    protected $fillable =  ['name', 'address1', 'address2', 'city', 'state_id', 'zip', 'lat', 'lon', 'phone', 'fax', 'notes', 'updated_at'];

    public function customer() {
      return $this->belongsTo('App\Customer');
    }

    public function systems() {
      return $this->hasMany('App\System')->orderBy('name', 'asc');
    }

    public function system_types() {
      return $this->hasManyThrough('App\System_type', 'App\System');
    }

    public function state()
    {
      return $this->belongsTo('App\State');
    }

    public function photos() {
      return $this->morphMany('App\Photo', 'photoable');
    }

    public function count_systems($id) {
      $systems_quantity = DB::table('systems')->where('site_id', $id)->count();
      return $systems_quantity;
    }

    public function get_travel_data($lat, $lon) {
      $fife_lat = '47.239556';
      $fife_lon = '-122.387691';
      $fife_api_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $fife_lat . "," . $fife_lon . "&destinations=" . $lat . "," . $lon . "&mode=car&language=en-EN&units=imperial";
      $pdx_lat = '45.579030';
      $pdx_lon = '-122.635391';
      $pdx_api_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $pdx_lat . "," . $pdx_lon . "&destinations=" . $lat . "," . $lon . "&mode=car&language=en-EN&units=imperial";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $pdx_api_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $pdx_data_decoded = json_decode(curl_exec($ch), true);

      $pdx_distance = $pdx_data_decoded['rows'][0]['elements'][0]['distance']['text'];
      $pdx_duration = $pdx_data_decoded['rows'][0]['elements'][0]['duration']['text'];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $fife_api_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $fife_data_decoded = json_decode(curl_exec($ch), true);

      $fife_distance = $fife_data_decoded['rows'][0]['elements'][0]['distance']['text'];
      $fife_duration = $fife_data_decoded['rows'][0]['elements'][0]['duration']['text'];

      $travel_data = [$pdx_distance, $pdx_duration, $fife_distance, $fife_duration];

      return $travel_data;
    }

}
