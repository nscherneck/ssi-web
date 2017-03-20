<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use DB;
use App\Http\Requests;

use App\Site;
use App\Customer;
use App\State;

class CustomersController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $customers = Customer::orderBy('name')->get();
      return view('customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
      $states = State::all();
      return view('customers.show', compact('customer', 'states'));
    }

    public function create()
    {
      $states = DB::table('states')->get();
      return view('customers.add', compact('states'));
    }

    public function store(Request $request)
    {

      $this->validate($request, [
        'name' => 'required|unique:customers|string|max:255',
        'address1' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state_id' => 'required|string|max:10',
        'zip' => 'required|string|max:20',
        'email' => 'email'
      ]);

      $customer = new Customer;
      $customer->name = $request->name;
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
      return redirect()->route('admin');
    }

    public function edit()
    {
      return 'edit';
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
      return redirect()->route('customer_show', ['id' => $customer->id]);
    }

    public function destroy(Customer $customer)
    {

      if(count($customer->sites) > 0) {
        flash('Nope!', 'Cannot delete customer, it has one or more sites.', 'warning');
        return redirect()->route('customer_show', ['id' => $customer->id]);
      } else {
        $customer->delete();
        flash('Success!', 'Customer deleted.', 'danger');
        return redirect()->route('admin');
      }

    }

}
