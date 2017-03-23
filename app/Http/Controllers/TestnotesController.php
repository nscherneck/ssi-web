<?php
namespace App\Http\Controllers;

use App\Test;
use App\Testnote;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestnotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, Test $test)
    {
        $testnote = new Testnote;
        $testnote->test_id = $test->id;
        $testnote->note = $request->note;
        $testnote->added_by = Auth::id();
        $testnote->save();
        
        flash('Success!', 'Note added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function update(Request $request, Test $test, Testnote $testnote)
    {
        $testnote = Testnote::find($testnote->id);
        $testnote->note = $request->note;
        $testnote->update();
        
        flash('Success!', 'Note updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
    
    public function destroy(Test $test, Testnote $testnote)
    {
        $testnote->delete();
        
        flash('Success!', 'Note deleted.', 'danger');
        
        return redirect()->route('test_show', ['id' => $test->id]);    
    }

}
