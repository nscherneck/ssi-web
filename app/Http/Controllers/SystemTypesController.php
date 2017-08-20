<?php
namespace App\Http\Controllers;

use DB;
use App\SystemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $systemTypes = DB::table('system_types')
            ->orderBy('type', 'asc')
            ->get();

        return view('system_types.add', compact('systemTypes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|unique:system_types'
            ]);

        $systemType = new SystemType;
        $systemType->type = $request->type;

        $systemType->save();

        return back();
    }
}
