<?php
namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Photo extends Model
{
    use LogsActivity, CreatedUpdatedInfo;

    protected $dates = [
        'updated_at',
        'created_at'
    ];

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

    protected static $logAttributes = [
        'caption'
    ];

    public function photoable()
    {
        return $this->morphTo();
    }

    public function pathToSystemPhoto()
    {
        return '/systems/photos' . '/' . $this->id;
    }

    public function getSystem($id)
    {
        $system = System::find($id);
        return $system;
    }

    public function getFilesize()
    {
        $result = round(Storage::size($this->path . "/" . $this->file_name . "." . $this->ext) / 1000000, 2) . " Mb";
        return $result;
    }
}
