<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'path',
        'description',
        'documentable_id',
        'documentable_type',
        'added_by',
        'updated_by',
        'ext',
        'file_name'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function addedBy() // user who uploaded
    {
        return $this->belongsTo('App\User', 'added_by');
    }

    public function updatedBy() // user who uploaded
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function getFullDocumentNameAttribute()
    {
        return $this->file_name . '.' . $this->ext;
    }
}
