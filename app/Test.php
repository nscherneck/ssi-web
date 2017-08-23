<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Test extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    protected $with = ['testType', 'testResult'];

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

    public function testResult()
    {
        return $this->belongsTo('App\TestResult');
    }

    public function testType()
    {
        return $this->belongsTo('App\TestType');
    }

    public function technician()
    {
        return $this->belongsTo('App\User', 'technician_id');
    }

    public function reports()
    {
        return $this->morphMany('App\Document', 'documentable');
    }

    public function testDeficiencies()
    {
        return $this->hasMany('App\TestDeficiency');
    }

    public function testNotes()
    {
        return $this->hasMany('App\TestNote');
    }

    public function path()
    {
        return '/tests/' . $this->id;
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
