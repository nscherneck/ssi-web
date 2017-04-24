<?php
namespace App\Http\Controllers;

use DB;
use App\Site;
use App\Test;
use App\System;
use App\Customer;
use App\TestFilters;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(TestFilters $filters)
    {
        $technicians = DB::table('users')->get();
        $test_results = DB::table('test_results')->get();
        $test_types = DB::table('test_types')->get();
        $tests = Test::filter($filters)
            ->orderBy('test_date', 'desc')
            ->get();

        return view('tests.index', compact(
            'tests', 
            'technicians', 
            'test_results', 
            'test_types'
            )
        );
    }
    
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
        
        $system->setNextTestDate($test->test_date);
        
        flash('Success!', 'Test created.');
        
        return redirect()->route('system_show', ['id' => $system->id]);
    }
    
    
    public function show(Test $test)
    {
        $test_types = DB::table('test_types')->get();
        $test_results = DB::table('test_results')->get();
        $technicians = DB::table('users')->get();

        return view('tests.show', compact(
            'test', 
            'test_types', 
            'test_results', 
            'technicians'
            )
        );
    }
    
    public function update(Request $request, Test $test)
    {
        $test->test_date = $request->test_date;
        $test->technician_id = $request->technician_id;
        $test->test_type_id = $request->test_type_id;
        $test->test_result_id = $request->test_result_id;
        $test->updated_by = Auth::id();
        $test->update();

        $test->system->setNextTestDate($test->test_date);        
        
        flash('Success!', 'Test updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function destroy(Test $test)
    {
        $system = System::find($test->system_id);
        $test->delete();
        
        $system_test_count = $system->tests()
            ->count();

        if($system_test_count >= 1) {
            $lastTest = $system->tests()
                ->orderBy('test_date', 'desc')
                ->first();
            $system->setNextTestDate($lastTest->test_date);
        } else {
            $system->next_test_date = null;
            $system->update();
        }
        
        flash('Success!', 'Test deleted.', 'danger');

        return redirect()->route('system_show', ['id' => $system->id]);
    }
    
    public function search(Request $request)
    {    
        $query = Test::orderBy('test_date', 'desc')
            ->with(['test_result', 'test_type', 'system.site.customer']);
        
        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);           
        }

        if ($request->start_date || $request->end_date) {
            $query->whereBetween('test_date', [$request->start_date, $request->end_date]);           
        }

        if ($request->test_result_id) {
            $query->where('test_result_id', $request->test_result_id);           
        }

        if ($request->system_type_id) {
            $query->whereHas('system', function ($subQuery) use ($request) {
                $subQuery->where('system_type_id', '=', $request->system_type_id);   
            });        
        }

        if ($request->has_reports == 1) {
            $query->has('reports');        
        }

        if ($request->has_reports == 2) {
            $query->doesntHave('reports');        
        }

        $tests = $query->get();           
        
        return view('tests.search_results', compact('tests'));
    }

}
