<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the Systems that this Component is associated with.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function systems()
    {
        return $this->belongsToMany('App\System', 'components_systems', 'component_id', 'system_id')
            ->withPivot('quantity', 'name', 'id');
    }

    /**
     * Get the Categories that this Component belongs to.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function componentCategory()
    {
        return $this->belongsTo('App\ComponentCategory');
    }

    /**
     * Get the Manufacturer that this Component belongs to.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer')->orderBy('name', 'asc');
    }

    /**
     * Get the Documents associated with this Component.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function documents()
    {
        return $this->morphMany('App\Document', 'documentable');
    }

    /**
     * Get the formatted description excerpt (100 characters in length) for this Component.
     */
    public function getFormattedDescriptionAttribute()
    {
        if (strlen($this->description) > 100) {
            return str_limit($this->description, 100);
        }

        return $this->description;
    }
}
