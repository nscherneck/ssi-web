<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Test;
use App\Deficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeficienciesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, Test $test)
    {
        $deficiency = new Deficiency;
        $deficiency->test_id = $test->id;
        $deficiency->description = $request->description;
        $deficiency->added_by = Auth::id();
        $deficiency->save();
        
        flash('Success!', 'Deficiency added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function update(Request $request, Test $test, Deficiency $deficiency)
    {
        $deficiency = Deficiency::find($deficiency->id);
        $deficiency->description = $request->description;
        $deficiency->update();
        
        flash('Success!', 'Deficiency updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);    
    }
    
    public function destroy(Test $test, Deficiency $deficiency)
    {
        $deficiency->delete();
        
        flash('Success!', 'Deficiency deleted.', 'danger');

        return redirect()->route('test_show', ['id' => $test->id]);    
    }

}
