<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class System extends Model
{
    use LogsActivity;

    protected $with = ['site', 'tests', 'system_type', 'components'];

    protected $dates = [
        'install_date',
        'next_test_date',
        'created_at',
        'updated_at'
        ];

    protected $fillable = [
        'system_type_id',
        'name',
        'slug',
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
        'notes',
        'next_test_date'
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

    public function path()
    {
        return '/systems/' . $this->id;
    }

    public function attachComponent($component, $quantity, $name)
    {
        $this->components()
            ->attach($component, [
              'quantity' => $quantity,
              'name' => $name
              ]);
    }

    public function detachComponent($attachedComponentPivotId)
    {
        DB::table('components_systems')
            ->where('id', $attachedComponentPivotId)
            ->delete();
    }

    public function getCustomerAttribute()
    {
        return $this->site->customer;
    }

    public function getFormattedNextTestDateAttribute()
    {
        if (is_null($this->next_test_date)) {
            return '';
        }

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
        $test_count = $this->tests->count();

        if ($test_count == 0) {
            return '';
        }

        $result = $this->tests()
                ->orderBy('test_date', 'desc')
                ->first();
        return $result->test_date
                ->format('M j, Y');
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
        $this->next_test_date = $testDate->addMonths($this->system_type->test_interval)
            ->format('Y-m-d');
        $this->save();
    }

    public function sumComponents()
    {
        return DB::table('components_systems')->where('system_id', $this->id)
            ->pluck('quantity')
            ->sum();
    }

    public function scopeIsTestedBySSI($query)
    {
        return $query->where('ssi_test_acct', 1);
    }

    public function getComponentsQuantity()
    {
        $a = $this->components();
        $a1 = $a->selectRaw($a->getForeignKey() . ', sum(quantity)')
                ->groupBy($a->getForeignKey());

        return $a1;
    }
}
