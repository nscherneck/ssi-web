<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $fillable = [
        'name',
        'address1',
        'address2',
        'city',
        'state_id',
        'zip',
        'phone',
        'fax',
        'latitude',
        'longitude'
    ];

    /**
     * @var bool False turns off timestamps for the model, delete to keep them on.
     */
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
