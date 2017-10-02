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

    /*
     * The attributes to be logged using Spatie laravel-activitylog
     */
    protected static $logAttributes = [
        'caption'
    ];

    /**
     * Get all of the owning photoable models.
     */
    public function photoable()
    {
        return $this->morphTo();
    }

    /*
    * Get the url path associated with this Photo
    */
    public function pathToSystemPhoto()
    {
        return '/systems/photos' . '/' . $this->id;
    }

    /*
    * Get the file size of the Photo
    */
    public function getFilesize()
    {
        $result = round(Storage::size($this->path . "/" . $this->file_name . "." . $this->ext) / 1000000, 2) . " Mb";
        return $result;
    }
}
