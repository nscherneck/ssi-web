<?php

namespace App;

use DB;
use App\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Test extends Model
{

    use LogsActivity;
    
    protected $dates = [
        'test_date', 
        'updated_at', 
        'created_at'
        ];    
    protected $fillable = [
        'test_date', 
        'added_by', 
        'technician_id', 
        'system_id', 
        'test_result_id', 
        'test_type_id', 
        'added_by', 
        'updated_by', 
        'updated_at'
        ];    
    protected static $logAttributes = [
        'test_date', 
        'test_type_id', 
        'test_result', 
        'system_id'
        ];
    
    public function system()
    {
        return $this->belongsTo('App\System');
    }
    
    public function test_result()
    {
        return $this->belongsTo('App\Test_result');
    }
    
    public function test_type()
    {
        return $this->belongsTo('App\Test_type');
    }
    
    public function technician()
    {
        return $this->belongsTo('App\User', 'technician_id');
    }
    
    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }
    
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
    
    public function reports() 
    {
        return $this->morphMany('App\Document', 'documentable');
    }
    
    public function deficiencies()
    {
        return $this->hasMany('App\Deficiency');
    }
    
    public function testnotes()
    {
        return $this->hasMany('App\Testnote');
    }
    
    public function scopeOfRange($query, $start_date, $end_date)
    {
        return $query->whereBetween('test_date', [$start_date, $end_date]);
    }
    
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
    
    public function getFormattedTestDateAttribute()
    {
        return $this->test_date->format('F j, Y');
    }

    public function setServiceViewRowColor()
    {
        if ($this->test_result_id == 2) {
            return "class=\"warning\"";
        } elseif ($this->test_result_id == 3) {
            return "class=\"danger\"";
        }
    }

}
