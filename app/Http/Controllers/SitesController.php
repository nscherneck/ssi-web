<?php
namespace App\Http\Controllers;

use App\BranchOffice;
use App\Customer;
use App\Http\Requests;
use App\Site;
use App\State;
use App\System;
use App\System_type;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SitesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $sites = Site::withCount('systems')
            ->with(['customer', 'systems.tests', 'state'])
            ->orderBy('id', 'desc')
            ->get();

        return view('sites.index', compact('sites'));
    }
    
    public function show(Site $site)
    {
        $states = State::all();
        $branchOffices = BranchOffice::all();
        $system_types = System_type::orderBy('type')->get();

        return view('sites.show', compact('site', 'system_types', 'states', 'branchOffices'));
    }
    
    public function store(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|unique:sites|string|max:255',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required',
            'zip' => 'required|string|max:20',
            'branch_office_id' => 'required'
            ]);

        $site = new Site;
        $site->customer_id = $customer->id;
        $site->name = $request->name;
        $site->slug = str_slug($site->name, '-');
        $site->address1 = $request->address1;
        $site->address2 = $request->address2;
        $site->city = $request->city;
        $site->state_id = $request->state_id;
        $site->zip = $request->zip;
        $site->branch_office_id = $request->branch_office_id;
        $site->lat = $request->lat;
        $site->lon = $request->lon;
        $site->phone = $request->phone;
        $site->fax = $request->fax;
        $site->notes = $request->notes;
        $site->added_by = Auth::id();
        
        $site->save();
        
        flash('Success!', 'Site created.');

        return redirect()->route('site_show', ['site' => $site->id, 'slug' => $site->slug]);
    }
    
    public function edit(Site $site)
    {
        $customer = Customer::find($site->customer_id);

        return view('sites.edit', compact('site', 'customer'));
    }
    
    public function update(Request $request, Site $site)
    {    
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required',
            'zip' => 'required|string|max:20',
            'branch_office_id' => 'required',
            ]);
        
        $site->name = $request->name;
        $site->slug = str_slug($site->name, '-');
        $site->address1 = $request->address1;
        $site->address2 = $request->address2;
        $site->city = $request->city;
        $site->state_id = $request->state_id;
        $site->zip = $request->zip;
        $site->branch_office_id = $request->branch_office_id;
        $site->lat = $request->lat;
        $site->lon = $request->lon;
        $site->phone = $request->phone;
        $site->fax = $request->fax;
        $site->notes = $request->notes;
        $site->updated_by = Auth::id();
        
        $site->update();
        
        flash('Success!', 'Site updated.', 'success');

        return redirect()->route('site_show', ['site' => $site->id, 'slug' => $site->slug]);
    }
    
    public function destroy(Site $site)
    {    
        if (count($site->systems) > 0) {
            flash('Nope!', 'Cannot delete site, it has one or more systems.', 'warning');
            return redirect()->route('site_show', ['site' => $site->id, 'slug' => $site->slug]);
        }

        $customer = Customer::find($site->customer_id);
        $site->delete();
        flash('Success!', 'Site deleted.', 'danger');
        return redirect()->route('customer_show', ['customer' => $customer->id, 'slug' => $customer->slug]);
    }

}
