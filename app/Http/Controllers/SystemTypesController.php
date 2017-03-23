<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\System_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SystemTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        $system_types = DB::table('system_types')
            ->orderBy('type', 'asc')
            ->get();

        return view('system_types.add', compact('system_types'));
    }
    
    public function store(Request $request)
    {    
        $this->validate($request, [
            'type' => 'required|unique:system_types'
            ]);
        
        $system_type = new System_type;
        $system_type->type = $request->type;

        $system_type->save();
        
        return back();    
    }

}
