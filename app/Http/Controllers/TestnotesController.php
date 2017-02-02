<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Test;
use App\Testnote;

class TestnotesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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

      //  flash('Note deleted', 'Error');
      flash('Success!', 'Note deleted.', 'danger');
      //  notify()->flash('Note deleted', 'error', [
      //     'timer' => 2000,
      // ]);
       return redirect()->route('test_show', ['id' => $test->id]);

     }
}
