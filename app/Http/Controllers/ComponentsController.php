<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Site;
use App\System;
use App\Component;
use App\Document;
use App\Manufacturer;
use App\ComponentCategory;
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

    public function add(System $system)
    {
        $site = Site::find($system->site_id);
        $customer = Customer::with('sites.systems.components')->find($site->customer_id);
        $manufacturers = DB::table('manufacturers')
            ->orderBy('name', 'asc')
            ->get();

        return view(
            'components.add',
            compact(
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
            'manufacturer_id' => 'required',
            'model' => 'required|unique:components|max:150',
            'component_category_id' => 'required',
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
        $componentCategories = DB::table('component_category')
            ->orderBy('name', 'asc')
            ->get();

        return view('components.create', compact('manufacturers', 'componentCategories'));
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
        $system->attachComponent($request->component_id, $request->quantity, $request->name);

        flash('Success!', 'Component attached.');

        return redirect($system->path());
    }

    public function detach(System $system, $attachedComponentPivotId)
    {
        $system->detachComponent($attachedComponentPivotId);

        flash('Success!', 'Component removed.', 'success');

        return redirect($system->path());
    }

    public function show(Component $component)
    {
        $documents = Document::orderBy('file_name', 'desc')
            ->where('documentable_id', $component->id)
            ->where('documentable_type', 'App\Component')
            ->get();
        $componentCategories = DB::table('component_category')
            ->orderBy('name', 'asc')
            ->get();
        return view(
            'components.show',
            compact(
                'component',
                'documents',
                'componentCategories'
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


    public function destroy(Component $component)
    {
        DB::table('components_systems')
            ->where('component_id', $component->id)
            ->delete();
        // DOCUMENT DELETION IS NOT COMPLETE, NEED TO ALSO DELETE FILE FROM STORAGE..
        Document::where('documentable_id', $component->id)
            ->where('documentable_type', 'App\Component')
            ->delete();
        $manufacturer = $component->manufacturer;
        $component->delete();
        flash('Success!', 'Component deleted.', 'danger');
        return redirect()->route('manufacturer_show', ['id' => $manufacturer->id]);
    }
}
