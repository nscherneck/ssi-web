<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Component;
use App\Document;
use App\Manufacturer;
use App\Component_category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ComponentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function add(System $system) {
        $site = Site::find($system->site_id);
        $customer = Customer::with('sites.systems.components')->find($site->customer_id);
        $manufacturers = DB::table('manufacturers')
            ->orderBy('name', 'asc')
            ->get();

        return view('components.add', compact(
          'customer', 
          'site', 
          'system', 
          'component', 
          'manufacturers'
          )
        );    
    }    
    
    public function store(Request $request) 
    {
    
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
        $component->discontinued = $request->discontinued;
        
        $component->save();

        flash('Success!', 'Component created.', 'success');

        return redirect()->route('admin');
    
    }
    
    public function create()
    {
        $manufacturers = DB::table('manufacturers')
            ->orderBy('name', 'asc')
            ->get();
        $component_categories = DB::table('component_category')
            ->orderBy('name', 'asc')
            ->get();

        return view('components.create', compact('manufacturers', 'component_categories'));
    }
    
    public function getModelForAttachComponentModal(Request $request) 
    {
        // ajax call for model form select
        $manufacturer = Manufacturer::find($request->manufacturer_id);
        $components = $manufacturer->components()
            ->orderBy('model', 'desc')
            ->get();

        return $components;
    }
    
    public function attach(Request $request, System $system) 
    {    
        $system->components()->attach($request->component_id, [
          'quantity' => $request->quantity, 
          'name' => $request->name
          ]);        
        
        flash('Success!', 'Component attached.');

        return redirect()->route('system_show', ['id' => $system->id]);    
    }
    
    public function detach(System $system, $id)
    {
        DB::table('components_systems')
            ->where('id', $id)
            ->delete();
        
        flash('Success!', 'Component removed.', 'success');

        return redirect()->route('system_show', ['id' => $system->id]);
    }
    
    public function show(Component $component)
    {
        $documents = Document::orderBy('file_name', 'desc')
            ->where('documentable_id', '=', $component->id)
            ->where('documentable_type', '=', 'App\Component')
            ->get();
        $component_categories = DB::table('component_category')
            ->orderBy('name', 'asc')
            ->get();
        return view('components.show', compact(
          'component', 
          'documents', 
          'component_categories'
          )
        );
    }
    
    public function update(Request $request, Component $component)
    {
        $component->model = $request->model;
        $component->description = $request->description;
        $component->component_category_id = $request->component_category_id;
        $component->discontinued = $request->discontinued;
        $component->save();
        
        flash('Success!', 'Component updated.', 'success');

        return redirect()->route('component_show', ['id' => $component->id]);    
    }

}
