<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrderType extends Model
{
    public function workOrders()
    {
        return $this->hasMany('App\WorkOrder');
    }
}
