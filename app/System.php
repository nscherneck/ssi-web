<?php
namespace App;

use DB;
use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class System extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    protected $with = ['site', 'tests', 'systemType', 'components'];

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

    public function systemType()
    {
        return $this->belongsTo('App\SystemType');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
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

    public function getMostRecentTest()
    {
        if (count($this->tests) == 0) {
            return '';
        }

        return $this->tests()
                ->orderBy('test_date', 'desc')
                ->first()
                ->test_date
                ->format('M j, Y');
    }

    public function getComponent($component_category_id)
    {
        return $this->components()
            ->where('component_category_id', '=', $component_category_id)
            ->get();
    }

    public function setNextTestDate($testDate)
    {
        $this->next_test_date = $testDate->addMonths($this->systemType->test_interval)
            ->format('Y-m-d');
        $this->save();
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
