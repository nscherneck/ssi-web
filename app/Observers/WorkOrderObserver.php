<?php

namespace App\Observers;

use App\Site;
use App\WorkOrder;
use App\WorkOrderNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkOrderObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function creating(WorkOrder $workOrder)
    {
        $branchOfficeId = Site::findOrFail($this->request->site_id)->branch_office_id;
        $today = Carbon::today('America/Los_Angeles');
        $todaysWorkOrderCount = WorkOrder::where('created_at_pst', '>=', $today)->count();

        $workOrder->work_order_number = (new WorkOrderNumber)
            ->createWorkOrderNumber($branchOfficeId, $todaysWorkOrderCount);
        $workOrder->completed_by = null;
        $workOrder->status_id = 1;
        $workOrder->work_order_billing_status_id = 1;
        $workOrder->created_at_pst = Carbon::now()->timezone('America/Los_Angeles')
            ->toDateTimeString();
    }
}
