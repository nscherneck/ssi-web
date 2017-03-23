<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('home');
    }
    
    public function store(Request $request) 
    {    
        $user = New User;
        $user->save($request->all());
        
        return view('home');    
    }
    
}
