<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\Manufacturer;
use App\Component;
use App\State;
use DB;

class ManufacturersController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $manufacturers = Manufacturer::orderBy('name')->get();
      return view('manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
      return redirect()->route('admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Manufacturer $manufacturer)
    {
      if($request->has('sort')) {
        $components = Component::orderBy($request->sort)
          ->where('manufacturer_id', $manufacturer->id)
          ->get();
      } else {
        $components = Component::orderBy('model')
          ->where('manufacturer_id', $manufacturer->id)
          ->get();
      }
      $states = State::all();
      return view('manufacturers.show', compact('manufacturer', 'components', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
