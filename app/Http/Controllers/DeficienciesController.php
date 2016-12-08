<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Test;
use App\Deficiency;

class DeficienciesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //
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
    public function store(Request $request, Test $test)
    {
        $deficiency = new Deficiency;
        $deficiency->test_id = $test->id;
        $deficiency->description = $request->description;
        $deficiency->added_by = Auth::id();
        $deficiency->save();

        flash('Deficiency added', 'Success');
        return redirect()->route('test_show', ['id' => $test->id]);
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
    public function update(Request $request, Test $test, Deficiency $deficiency)
    {
        $deficiency = Deficiency::find($deficiency->id);
        $deficiency->description = $request->description;
        $deficiency->update();

        flash('Deficiency updated', 'Success');
        return redirect()->route('test_show', ['id' => $test->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test, Deficiency $deficiency)
    {
      $deficiency->delete();

      flash('Deficiency deleted', 'Error');
      return redirect()->route('test_show', ['id' => $test->id]);

    }
}
