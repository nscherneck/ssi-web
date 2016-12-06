<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class System extends Model
{

  protected $dates = ['install_date', 'next_test_date', 'created_at'];
  protected $fillable = ['system_type_id', 'name', 'install_date', 'ssi_install', 'ssi_test_acct', 'next_test_date', 'updated_at'];
  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function site() {
    return $this->belongsTo('App\Site');
  }

  public function components() {
    return $this->belongsToMany('App\Component', 'components_systems', 'system_id', 'component_id')->withPivot('quantity', 'name')->orderBy('model', 'asc');
  }

  public function tests() {
    return $this->hasMany('App\Test')->orderBy('test_date', 'desc');
  }

  public function system_type() {
    return $this->belongsTo('App\System_type');
  }

  public function photos() {
    return $this->morphMany('App\Photo', 'photoable');
  }

  public function get_latest_test() {
    $test_count = $this->tests()->count();
    if($test_count >= 1) {
      $result = $this->tests()->orderBy('test_date', 'desc')->first();
      return $result->test_date->format('F d, Y');
    } else {
      return "";
    }
  }

  public function getNextTest() {
    $test_count = $this->tests()->count();
    if($test_count >= 1) {
      $result = $this->tests()->orderBy('test_date', 'desc')->first();

      switch ($this->system_type_id) {
        case 1: // fire alarm
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 7: // fire sprinkler (wet)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 8: // fire sprinkler (dry)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 9: // fire sprinkler (preaction)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 10: // fire sprinkler (deluge)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 11: // fire sprinkler (foam)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 12: // fire extinguishers
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 15: // smoke detection (aspirating)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 16: // fire suppression (high-expansion foam)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 17: // fire suppression (water mist)
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 18: // backflow preventer
          return $result->test_date->addYear(1)->format('F Y');
          break;
        case 2: // fire suppression (clean agent)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 3: // fire suppression (inert gas)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 4: // fire suppression (dry chem)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 5: // fire suppression (wet chem)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 6: // fire suppression (aerosol)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 13: // fire suppression (low-pressure co2)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
        case 14: // fire suppression (high-pressure co2)
          return $result->test_date->addMonths(6)->format('F Y');
          break;
      }
    } else {
      return "";
    }
  }

  public function count_components() {
    $result = $this->components()->sum('quantity');
    return $result;
  }

  public function count_tests() {
    $result = $this->tests()->sum();
    return $result;
  }

  public function compPanel() {
    $result = $this->components()->where('component_category_id', '=', 1)->get();
    return $result;
  }

  public function compModularPanel() {
    $result = $this->components()->where('component_category_id', '=', 14)->get();
    return $result;
  }

  public function compControlEquipment() {
    $result = $this->components()->where('component_category_id', '=', 2)->get();
    return $result;
  }

  public function compAspiratingDetection() {
    $result = $this->components()->where('component_category_id', '=', 13)->get();
    return $result;
  }

  public function compDetection() {
    $result = $this->components()->where('component_category_id', '=', 3)->get();
    return $result;
  }

  public function compNotification() {
    $result = $this->components()->where('component_category_id', '=', 4)->get();
    return $result;
  }

  public function compMiscElectrical() {
    $result = $this->components()->where('component_category_id', '=', 10)->get();
    return $result;
  }

  public function compMisc() {
    $result = $this->components()->where('component_category_id', '=', 11)->get();
    return $result;
  }

  public function compAccessory() {
    $result = $this->components()->where('component_category_id', '=', 6)->get();
    return $result;
  }

  public function compUncategorized() {
    $result = $this->components()->where('component_category_id', '=', 12)->get();
    return $result;
  }

  public function compConsumable() {
    $result = $this->components()->where('component_category_id', '=', 5)->get();
    return $result;
  }

}
