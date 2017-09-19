<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use CreatedUpdatedInfo;

    protected $fillable = [
        'path',
        'description',
        'documentable_id',
        'documentable_type',
        'added_by',
        'updated_by',
        'ext',
        'file_name',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function getFullDocumentNameAttribute()
    {
        return $this->file_name . '.' . $this->ext;
    }
}
