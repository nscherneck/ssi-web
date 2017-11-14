<?php
namespace App\Http\Controllers;

use App\State;
use App\Component;
use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManufacturersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $manufacturers = Manufacturer::orderBy('name')->get();
        $states = DB::table('states')->orderBy('state')->get();
        return view('manufacturers.index', compact('manufacturers', 'states'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required',
            'zip' => 'required|string|max:20',
            'email' => 'email'
            ]);

        $manufacturer = new Manufacturer;
        $manufacturer->name = $request->name;
        $manufacturer->address1 = $request->address1;
        $manufacturer->address2 = $request->address2;
        $manufacturer->city = $request->city;
        $manufacturer->state_id = $request->state_id;
        $manufacturer->zip = $request->zip;
        $manufacturer->phone = $request->phone;
        $manufacturer->fax = $request->fax;
        $manufacturer->web = $request->web;
        $manufacturer->distributor_login = $request->distributor_login;
        $manufacturer->email = $request->email;
        $manufacturer->notes = $request->notes;
        $manufacturer->added_by = Auth::id();

        $manufacturer->save();
        flash('Success!', 'Manufacturer added.');
        return back();
    }

    public function show(Request $request, Manufacturer $manufacturer)
    {
        if ($request->has('sort')) {
            $components = Component::orderBy($request->sort)
                ->where('manufacturer_id', $manufacturer->id)
                ->get();
        } else {
            $components = Component::orderBy('model')
                ->where('manufacturer_id', $manufacturer->id)
                ->get();
        }
        
        $componentCategories = DB::table('component_category')->orderBy('name', 'asc')->get();
        $states = State::all();

        return view('manufacturers.show', compact('manufacturer', 'components', 'componentCategories', 'states'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required',
            'zip' => 'required|string|max:20',
            'email' => 'email'
            ]);

        $manufacturer->name = $request->name;
        $manufacturer->address1 = $request->address1;
        $manufacturer->address2 = $request->address2;
        $manufacturer->city = $request->city;
        $manufacturer->state_id = $request->state_id;
        $manufacturer->zip = $request->zip;
        $manufacturer->phone = $request->phone;
        $manufacturer->fax = $request->fax;
        $manufacturer->web = $request->web;
        $manufacturer->distributor_login = $request->distributor_login;
        $manufacturer->email = $request->email;
        $manufacturer->notes = $request->notes;
        $manufacturer->updated_by = Auth::id();

        $manufacturer->save();

        flash('Success!', 'Manufacturer updated', 'success');

        return redirect()->route('manufacturer_show', ['id' => $manufacturer->id]);
    }
}
