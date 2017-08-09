<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrderStatus extends Model
{
    protected $table = 'work_order_status';

    public function workOrders()
    {
        return $this->hasMany('App\WorkOrder');
    }
}
