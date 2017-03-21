<?php

namespace App;

use App\System;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Photo extends Model
{

  use LogsActivity;

  protected $dates = ['updated_at', 'created_at'];
  protected $fillable = ['caption', 'photoable_id', 'photoable_type', 'path', 'file_name', 'ext', 'added_by', 'updated_by'];

  protected static $logAttributes = ['caption'];

  public function photoable()
  {
    return $this->morphTo();
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
    $result = round(Storage::size($this->path . "/" . $this->file_name . "." . $this->ext) / 1000000, 2) . " Mb";
    return $result;
  }

  public function getFormattedCreatedAtAttribute()
  {
    return $this->created_at->setTimezone('America/Los_Angeles')->format('l - F j, g:i A');
  }

}
