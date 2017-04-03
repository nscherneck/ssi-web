<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class System extends Model
{

    use LogsActivity;

    protected $dates = [
        'install_date', 
        'next_test_date', 
        'created_at', 
        'updated_at'
        ];
    protected $fillable = [
        'system_type_id', 
        'name', 
        'install_date', 
        'ssi_install', 
        'ssi_test_acct', 
        'next_test_date', 
        'notes', 
        'added_by', 
        'updated_by', 
        'updated_at'
        ];
    protected $casts = [
        'is_active' => 'boolean',
        ];
    protected static $logAttributes = [
        'notes'
        ];

    public function site() 
    {
        return $this->belongsTo('App\Site');
    }

    public function components() 
    {
        return $this->belongsToMany('App\Component', 'components_systems', 'system_id', 'component_id')
        ->withPivot('quantity', 'name', 'id')
        ->orderBy('model', 'asc');
    }

    public function tests() 
    {
        return $this->hasMany('App\Test')->orderBy('test_date', 'desc');
    }

    public function system_type() 
    {
        return $this->belongsTo('App\System_type');
    }

    public function photos() 
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function getFormattedNextTestDateAttribute()
    {
        return $this->next_test_date->setTimezone('America/Los_Angeles')
            ->format('F Y');
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

    public function getMostRecentTest() 
    {
        $test_count = $this->tests()->count();
        if($test_count >= 1) {
            $result = $this->tests()
            ->orderBy('test_date', 'desc')
            ->first();
            return $result->test_date->format('F d, Y');
        } else {
            return "";
        }
    }

    public function getComponent($component_category_id) 
    {
        $result = $this->components()
            ->where('component_category_id', '=', $component_category_id)
            ->get();
        
        return $result;
    }

    public function setNextTestDate($testDate)
    {
        $this->next_test_date = $testDate->addMonths($this->system_type->test_interval)->format('Y-m-d');
        $this->save();
      }

}
