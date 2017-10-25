<?php

namespace App\Http\Controllers\Admin;

use App\State;
use App\BranchOffice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderBy('state')->get();
        $branchoffices = BranchOffice::orderBy('name')->get();
        return view('admin.branch_offices.index', compact('states', 'branchoffices'));
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
            'name' => 'required|unique:branch_offices|string|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $branchoffice = new BranchOffice([
            'name' => $request->input('name'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'city' => $request->input('city'),
            'state_id' => $request->input('state'),
            'zip' => $request->input('zip'),
            'phone' => $request->input('phone'),
            'fax' => $request->input('fax'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        $branchoffice->save();
        flash('Success!', 'Branch office created.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
