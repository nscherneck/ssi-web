<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{
    /**
     * @var bool False turns off timestamps for the model, delete to keep them on.
     */
    public $timestamps = false;

    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'component_category';

    /**
     * Get the Components associated with this category.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function components()
    {
        return $this->hasMany('App\Component');
    }
}
