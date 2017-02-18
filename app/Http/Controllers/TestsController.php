<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Test;


class TestsController extends Controller
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
    public function create($id)
    {

      $system = System::find($id);
      $site = Site::find($system->site_id);
      $customer = Customer::find($site->customer_id);
      $test_types = DB::table('test_types')->get();
      $test_results = DB::table('test_results')->get();
      $technicians = DB::table('users')->get();
      return view('tests.add', compact('customer', 'site', 'system', 'test_types', 'test_results', 'technicians'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, System $system)
    {

      $this->validate($request, [
        'test_date' => 'required',
        'technician_id' => 'required',
        'test_type_id' => 'required',
        'test_result_id' => 'required',
      ]);

      $test = new Test;
      $test->test_date = $request->test_date;
      $test->technician_id = $request->technician_id;
      $test->test_type_id = $request->test_type_id;
      $test->test_result_id = $request->test_result_id;
      $test->system_id = $system->id;
      $test->added_by = Auth::id();
      $test->save();

      $system->next_test_date = $this->setNextTestDate($system, $test->test_date);
      $system->update();

      flash('Success!', 'Test created.');
      return redirect()->route('system_show', ['id' => $system->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
      $test_types = DB::table('test_types')->get();
      $test_results = DB::table('test_results')->get();
      $technicians = DB::table('users')->get();
      return view('tests.show', compact('test', 'test_types', 'test_results', 'technicians'));
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

    public function update(Request $request, Test $test)
    {
      $test->test_date = $request->test_date;
      $test->technician_id = $request->technician_id;
      $test->test_type_id = $request->test_type_id;
      $test->test_result_id = $request->test_result_id;
      $test->updated_by = Auth::id();
      $test->update();

      flash('Success!', 'Test updated.', 'success');
      return redirect()->route('test_show', ['id' => $test->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $system = System::find($test->system_id);
        $test->delete();

        $system_test_count = $system->tests()->count();
        if($system_test_count >= 1) {
          $last_test = $system->tests()->orderBy('test_date', 'desc')->first();
          $system->next_test_date = $this->setNextTestDate($system, $last_test->test_date);
          $system->update();
        } else {
          $system->next_test_date = NULL;
          $system->update();
        }

        flash('Success!', 'Test deleted.', 'danger');
        return redirect()->route('system_show', ['id' => $system->id]);
    }

    public function search(Request $request)
    {

      $customers = Customer::find($request->customer_id)->systems()->with(['tests' => function ($query) {
          $query->whereBetween('test_date', [$request->start_date, $request->end_date]);
      }])->get();

      // $tests = Test::ofRange($request->start_date, $request->end_date)->orderBy('test_date', 'desc')->get();
      // $customer = Customer::findOrFail($request->customer_id);

      // $tests = Test::orderBy('test_date', 'desc')
      //   ->whereBetween('test_date', [$request->start_date, $request->end_date])
      //   ->get();

      return view('tests.search_results', compact('customers'));
    }

    public function setNextTestDate($system, $date)
    {
        switch ($system->system_type_id) {
          case 1: // fire alarm
            return $date->addYear(1)->format('Y-m-d');
          case 7: // fire sprinkler (wet)
            return $date->addYear(1)->format('Y-m-d');
          case 8: // fire sprinkler (dry)
            return $date->addYear(1)->format('Y-m-d');
          case 9: // fire sprinkler (preaction)
            return $date->addYear(1)->format('Y-m-d');
          case 10: // fire sprinkler (deluge)
            return $date->addYear(1)->format('Y-m-d');
          case 11: // fire sprinkler (foam)
            return $date->addYear(1)->format('Y-m-d');
          case 12: // fire extinguishers
            return $date->addYear(1)->format('Y-m-d');
          case 15: // smoke detection (aspirating)
            return $date->addYear(1)->format('Y-m-d');
          case 16: // fire suppression (high-expansion foam)
            return $date->addYear(1)->format('Y-m-d');
          case 17: // fire suppression (water mist)
            return $date->addYear(1)->format('Y-m-d');
          case 18: // backflow preventer
            return $date->addYear(1)->format('Y-m-d');
          case 2: // fire suppression (clean agent)
            return $date->addMonths(6)->format('Y-m-d');
          case 3: // fire suppression (inert gas)
            return $date->addMonths(6)->format('Y-m-d');
          case 4: // fire suppression (dry chem)
            return $date->addMonths(6)->format('Y-m-d');
          case 5: // fire suppression (wet chem)
            return $date->addMonths(6)->format('Y-m-d');
          case 6: // fire suppression (aerosol)
            return $date->addMonths(6)->format('Y-m-d');
          case 13: // fire suppression (low-pressure co2)
            return $date->addMonths(6)->format('Y-m-d');
          case 14: // fire suppression (high-pressure co2)
            return $date->addMonths(6)->format('Y-m-d');
        }

    }

}
