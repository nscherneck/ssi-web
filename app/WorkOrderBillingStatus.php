<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrderBillingStatus extends Model
{
    
    protected $table = 'work_order_billing_status';

    public function workOrders()
    {
    	return $this->hasMany('App\WorkOrder');
    }
    
}
