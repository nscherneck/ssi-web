<?php

namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Photo extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'caption',
        'photoable_id',
        'photoable_type',
        'path',
        'file_name',
        'ext',
        'added_by',
        'updated_by'
    ];

    /**
     * The attributes to be logged using Spatie laravel-activitylog
     *
     * @var array
     */
    protected static $logAttributes = [
        'caption'
    ];

    /**
     * Get all of the owning photoable models.
     *
     * @link https://laravel.com/docs/5.4/eloquent-relationships#polymorphic-relations Laravel documentation link
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }

    /**
     * Get the url path associated with this Photo
     *
     * @return string
     */
    public function pathToSystemPhoto()
    {
        return '/systems/photos' . '/' . $this->id;
    }

    /**
     * Get the file size of the Photo
     *
     * @return string
     */
    public function getFilesize()
    {
        return round(Storage::size($this->path . "/" . $this->file_name . "." . $this->ext) / 1000000, 2) . " Mb";
    }
}
