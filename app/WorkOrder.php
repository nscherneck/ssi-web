<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WorkOrder extends Model
{
    use LogsActivity;

	protected $guarded = [];
	
    public function path()
    {
    	return "/workorders/{$this->id}";
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    public function assignedTechnician()
    {
        return $this->belongsTo('App\User', 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function status()
    {
        return $this->belongsTo('App\WorkOrderStatus');
    }

    public function billingStatus()
    {
        return $this->belongsTo('App\WorkOrderBillingStatus', 'work_order_billing_status_id');
    }

    public function type()
    {
    	return $this->belongsTo('App\WorkOrderType');
    }

}
