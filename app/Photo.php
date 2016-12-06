<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\System;

class Photo extends Model
{
    public function photoable()
    {
      $this->morphTo();
    }

    public function addedBy() // user who uploaded
    {
      return $this->belongsTo('App\User', 'added_by');
    }

    public function getSystem($id)
    {
      $system = System::find($id);
      return $system;
    }

    public function getSize()
    {
      $result = round(Storage::size($this->path) / 1000000, 2) . " Mb";
      return $result;
    }

}
