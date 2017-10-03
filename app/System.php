<?php
namespace App;

use DB;
use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class System extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['site', 'tests', 'systemType', 'components'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'install_date',
        'next_test_date',
        'created_at',
        'updated_at'
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes to be logged using Spatie laravel-activitylog.
     *
     * @link https://github.com/spatie/laravel-activitylog GitHub repo for the Spatie package
     */
    protected static $logAttributes = [
        'notes',
        'next_test_date'
    ];

    /**
     * Get the Site that this System belongs to.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many-inverse Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    /**
     * Get the Components attached to this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#many-to-many Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function components()
    {
        return $this->belongsToMany('App\Component', 'components_systems', 'system_id', 'component_id')
            ->withPivot('quantity', 'name', 'id')
            ->orderBy('model', 'asc');
    }

    /**
     * Get the Tests for this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany('App\Test')->orderBy('test_date', 'desc');
    }

    /**
     * Get the type for this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many-inverse Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function systemType()
    {
        return $this->belongsTo('App\SystemType');
    }

    /**
     * Get the Photos associated with this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#polymorphic-relations Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /**
     * Get the url path associated with this Site.
     *
     * @return string
     */
    public function path()
    {
        return '/systems/' . $this->id;
    }

    /**
     * Attaches a component to this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#updating-many-to-many-relationships Laravel documentation
     *
     * @param  string $component The component ID.
     * @param  string $quantity  The quantity of components.
     * @param  string $name      A description of the component.
     */
    public function attachComponent($component, $quantity, $name)
    {
        $this->components()->attach($component, [
                'quantity' => $quantity,
                'name' => $name
            ]);
    }

    /**
     * Detaches a component to this System.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#updating-many-to-many-relationships Laravel documentation
     *
     * @param  string $attachedComponentPivotId The component ID.
     */
    public function detachComponent($attachedComponentPivotId)
    {
        DB::table('components_systems')
            ->where('id', $attachedComponentPivotId)
            ->delete();
    }

    /**
     * Gets the Customer relationship, via the Site.
     *
     * @return string
     */
    public function getCustomerAttribute()
    {
        return $this->site->customer;
    }

    /**
     * Get the next test date formatted like "January 2018"
     *
     * @link https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor Laravel documentation.
     *
     * @return string
     */
    public function getFormattedNextTestDateAttribute()
    {
        if (is_null($this->next_test_date)) {
            return '';
        }

        return $this->next_test_date->setTimezone('America/Los_Angeles')
            ->format('F Y');
    }

    /**
     * Get the date of the most recent test formatted like "Jan 1, 2018"
     *
     * @link https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor Laravel documentation.
     *
     * @return string
     */
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

    /**
     * Get this System's Components by Category.
     *
     * @param  string $component_category_id The category ID.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getComponent($component_category_id)
    {
        return $this->components()
            ->where('component_category_id', '=', $component_category_id)
            ->get();
    }

    /**
     * Set this System's next test date.  Gets called in TestsController.
     *
     * @param string $testDate [description]
     */
    public function setNextTestDate($testDate)
    {
        $this->next_test_date = $testDate->addMonths($this->systemType->test_interval)
            ->format('Y-m-d');
        $this->save();
    }

    /**
     * Filter Systems to those tested by SSI.
     *
     * @link https://laravel.com/docs/5.4/eloquent#local-scopes Lravel documentation.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsTestedBySSI($query)
    {
        return $query->where('ssi_test_acct', 1);
    }

    /**
     * Get the quantity of Components for this System.
     *
     * @link https://laravel.com/api/5.4/Illuminate/Database/Query/Builder.html#method_selectRaw Laravel documentation.
     *
     * @return string Quantity of components.
     */
    public function getComponentsQuantity()
    {
        $components = $this->components();
        $quantityOfComponents = $components->selectRaw($components->getForeignKey() . ', sum(quantity)')
                ->groupBy($components->getForeignKey());

        return $quantityOfComponents;
    }
}
