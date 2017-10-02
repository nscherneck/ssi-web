<?php

namespace App\Traits;

trait CreatedUpdatedInfo
{
    /**
    * Get the User who added this Model
    */
    public function addedBy()
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    /**
    * Get the User who updated this Model
    */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    /**
    * Get the date / time when the mode was updated, formatted like January 1, 2017 1:00am
    */
    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }

    /**
    * Get the date / time when the mode was created, formatted like January 1, 2017 1:00am
    */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->setTimezone('America/Los_Angeles')
            ->format('F j, Y, g:i a');
    }
}
