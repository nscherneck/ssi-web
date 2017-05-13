<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use App\Customer;
use App\WorkOrder;
use Carbon\Carbon;
use App\WorkOrderNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workOrders = WorkOrder::orderBy('created_at', 'desc')->get();

        return view('workorders.index', compact('workOrders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $workOrderTypes = DB::table('work_order_types')->get();
        $technicians = User::orderBy('first_name')->get();
        return view('workorders.create', compact('customers', 'workOrderTypes', 'technicians'));       
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'scope_of_work' => 'required'
            ]);
        
        // see app/Observers/WorkOrderObserver@creating for additional fields
        $workOrder = WorkOrder::create([
            'type_id' => request('type_id'),
            'site_id' => request('site_id'),
            'created_by' => auth()->id(),
            'assigned_to' => request('assigned_to'),
            'point_of_contact' => request('point_of_contact'),
            'customer_purchase_order' => request('customer_purchase_order'),
            'title' => request('title'),
            'scope_of_work' => request('scope_of_work'),
            ]);

        return redirect($workOrder->path());
    }

    public function show(WorkOrder $workOrder)
    {
        return view('workorders.show', compact('workOrder'));
    }

    public function edit(WorkOrder $workOrder)
    {
        //
    }

    public function update(Request $request, WorkOrder $workOrder)
    {
        $workOrder->update($request->all());
    }

    public function destroy(WorkOrder $workOrder)
    {
        //
    }

    public function getSites(Request $request)
    {
        // ajax call for site form select
        $customer = Customer::find($request->customer_id);
        $sites = $customer->sites()
            ->orderBy('name')
            ->get();

        return $sites;        
    }
}
