<?php
namespace App\Http\Controllers;

use App\Test;
use App\TestNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Test $test)
    {
        $testNote = new TestNote;
        $testNote->test_id = $test->id;
        $testNote->note = $request->note;
        $testNote->added_by = Auth::id();
        $testNote->save();

        flash('Success!', 'Note added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function update(Request $request, Test $test, TestNote $testNote)
    {
        $testNote->note = $request->note;
        $testNote->update();

        flash('Success!', 'Note updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function destroy(Test $test, TestNote $testNote)
    {
        $testNote->delete();

        flash('Success!', 'Note deleted.', 'danger');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
}
