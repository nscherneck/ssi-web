<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Component;
use App\Manufacturer;
use App\Component_category;
use DB;


class ComponentsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function add(System $system) {
    $site = Site::find($system->site_id);
    $customer = Customer::with('sites.systems.components')->find($site->customer_id);
    $manufacturers = DB::table('manufacturers')->orderBy('name', 'asc')->get();
    return view('components.add', compact('customer', 'site', 'system', 'component', 'manufacturers'));
  }

  public function create(Request $request) {

    $this->validate($request, [
      //  'manufacturer_id' => 'required',
      //  'model' => 'required|unique:components|max:150',
      //  'component_category_id' => 'required',
       'description' => 'required'
   ]);

    $component = new Component;
    $component->manufacturer_id = $request->manufacturer_id;
    $component->model = $request->model;
    $component->component_category_id = $request->component_category_id;
    $component->description = $request->description;

    $component->save();

    return redirect()->route('admin');

  }


  public function create_page() {
    $manufacturers = DB::table('manufacturers')->orderBy('name', 'asc')->get();
    $component_categories = DB::table('component_category')->orderBy('name', 'asc')->get();
    return view('components.create', compact('manufacturers', 'component_categories'));
  }

  public function update_component_form(Request $request) {
    // ajax call for model form select
    $manufacturer = Manufacturer::find($request->manufacturer_id);
    $components = $manufacturer->components()->orderBy('model', 'desc')->get();
    return $components;
  }

  public function attach(Request $request, System $system) {

    $system->components()->attach($request->component_id, ['quantity' => $request->quantity, 'name' => $request->name, ]);

    flash('Component attached', 'Success');
    return redirect()->route('system_show', ['id' => $system->id]);

  }

  public function detach(System $system, $id)
  {
    $system->components()->detach($component->id);

    flash('Component detached', 'Success');
    return redirect()->route('system_show', ['id' => $system->id]);
  }


}
