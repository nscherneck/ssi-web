<?php
namespace App\Http\Controllers;

use App\Test;
use App\TestDeficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestDeficienciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Test $test)
    {
        $testDeficiency = new TestDeficiency;
        $testDeficiency->test_id = $test->id;
        $testDeficiency->description = $request->description;
        $testDeficiency->added_by = Auth::id();
        $testDeficiency->save();

        flash('Success!', 'Deficiency added.');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function update(Request $request, Test $test, testDeficiency $testDeficiency)
    {
        $testDeficiency->description = $request->description;
        $testDeficiency->update();

        flash('Success!', 'Deficiency updated.', 'success');

        return redirect()->route('test_show', ['id' => $test->id]);
    }

    public function destroy(Test $test, TestDeficiency $testDeficiency)
    {
        $testDeficiency->delete();

        flash('Success!', 'Deficiency deleted.', 'danger');

        return redirect()->route('test_show', ['id' => $test->id]);
    }
}
