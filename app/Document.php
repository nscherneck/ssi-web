<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use CreatedUpdatedInfo;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
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

    /**
    * Get all of the owning documentable models.
    *
    * @link https://laravel.com/docs/5.4/eloquent-relationships#polymorphic-relations Laravel documentation link
    */
    public function documentable()
    {
        return $this->morphTo();
    }

    /**
    * Get the document's full file name with extension
    *
    * @link https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor Laravel documentation link
    */
    public function getFullDocumentNameAttribute()
    {
        return $this->file_name . '.' . $this->ext;
    }
}
