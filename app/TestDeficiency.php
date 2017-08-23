<?php
namespace App;

use App\Traits\CreatedUpdatedInfo;
use Illuminate\Database\Eloquent\Model;

class TestDeficiency extends Model
{
    use CreatedUpdatedInfo;

    public function test()
    {
        return $this->belongsTo('App\Test');
    }
}
