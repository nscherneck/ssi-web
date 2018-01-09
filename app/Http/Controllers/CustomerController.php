<?php
namespace App\Http\Controllers;

use App\State;
use App\Customer;
use App\BranchOffice;
use Illuminate\Http\Request;
use App\Filters\CustomerFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index(CustomerFilter $filters)
    {
        $customers = $this->getCustomers($filters)
            ->orderBy('name')
            ->get();
        $states = DB::table('states')->orderBy('state')->get();
        return view('customers.index', compact('customers', 'states'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:customers|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable',
            'address3' => 'nullable',
            'city' => 'required|string|max:255',
            'state_id' => 'required|string|max:10',
            'zip' => 'required|string|max:20',
            'phone' => 'nullable',
            'fax' => 'nullable',
            'web' => 'nullable',
            'email' => 'nullable|email',
            'notes' => 'nullable'
            ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->slug = str_slug($customer->name, '-');
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->address3 = $request->address3;
        $customer->city = $request->city;
        $customer->state_id = $request->state_id;
        $customer->zip = $request->zip;
        $customer->phone = $request->phone;
        $customer->fax = $request->fax;
        $customer->web = $request->web;
        $customer->email = $request->email;
        $customer->notes = $request->notes;
        $customer->added_by = Auth::id();

        $customer->save();
        flash('Success!', 'Customer created.');
        return redirect($customer->path());
    }

    public function show(Customer $customer)
    {
        $states = State::all();
        $branchOffices = BranchOffice::all();
        return view('customers.show', compact('customer', 'states', 'branchOffices'));
    }

    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required',
            'zip' => 'required|string|max:20',
            'email' => 'email'
        ]);

        $customer->name = $request->name;
        $customer->slug = str_slug($customer->name, '-');
        $customer->address1 = $request->address1;
        $customer->address2 = $request->address2;
        $customer->address3 = $request->address3;
        $customer->city = $request->city;
        $customer->state_id = $request->state_id;
        $customer->zip = $request->zip;
        $customer->phone = $request->phone;
        $customer->fax = $request->fax;
        $customer->web = $request->web;
        $customer->email = $request->email;
        $customer->notes = $request->notes;
        $customer->updated_by = Auth::id();

        $customer->update();
        flash('Success!', 'Customer updated.', 'success');
        return redirect($customer->path());
    }

    public function destroy(Customer $customer)
    {
        if (count($customer->sites) > 0) {
            flash('Nope!', 'Cannot delete customer, it has one or more sites.', 'warning');
            return redirect($customer->path());
        }

        $customer->delete();
        flash('Success!', 'Customer deleted.', 'danger');
        return redirect()->route('customers.index');
    }
    
    public function getCustomers($filters)
    {
        return Customer::filter($filters);
    }
}
