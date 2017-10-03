<?php
namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use CreatedUpdatedInfo;

    /**
     * Get the Components associated with this Manufacturer
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function components()
    {
        return $this->hasMany('App\Component')->orderBy('model', 'asc');
    }

    /**
     * Get the state where this Manufacturer is located (address)
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#one-to-many-inverse Laravel documentation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Get the url path associated with this Manufacturer
     *
     * @return string
     */
    public function path()
    {
        return '/manufacturer/' . $this->id;
    }
}
