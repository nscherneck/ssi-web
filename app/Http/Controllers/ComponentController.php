<?php
namespace App\Http\Controllers;

use App\System;
use App\Component;
use App\Document;
use App\Manufacturer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ComponentController extends Controller
{
    public function store(Manufacturer $manufacturer, Request $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'component_category_id' => 'required',
            'description' => 'required'
        ]);

        $component = new Component;
        $component->manufacturer_id = $manufacturer->id;
        $component->model = $request->model;
        $component->component_category_id = $request->component_category_id;
        $component->description = $request->description;
        $component->discontinued = $request->discontinued == null ? 0 : 1;
        $component->notes = $request->notes;

        $component->save();
        flash('Success!', 'Component created.', 'success');
        return back();
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
        $component->notes = $request->notes;
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
