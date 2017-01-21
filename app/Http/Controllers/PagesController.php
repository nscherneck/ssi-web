<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests;
use App\Customer;
use App\Site;
use App\System;
use App\Test;
use App\Photo;
use DB;

class PagesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function home()
    {
      $recentphotos = Photo::orderBy('created_at', 'desc')
      ->take(10)
      ->get();

      return view('home', compact('recentphotos'));
    }

    public function customer()
    {
      return view('customer');
    }

    public function sales()
    {
      return view('sales');
    }

    public function engineering()
    {
      return view('engineering');
    }

    public function installation()
    {
      return view('installation');
    }

    public function service()
    {
      // get 20 most recent tests
      $tests = Test::orderBy('test_date', 'desc')->take(25)->get();

      // systems due for test
      $start_date_raw = Carbon::now('America/Los_Angeles')->startOfMonth();
      $start_date = $start_date_raw->toDateString();
      $end_date = $start_date_raw->addMonths(4)->toDateString();

      $systemduefortest = System::orderBy('next_test_date', 'asc')
        ->where('next_test_date', '!=', NULL)
        ->whereBetween('next_test_date', [$start_date, $end_date])
        ->get();

      $recentphotos = Photo::orderBy('created_at', 'desc')->take(5)->get();
      $recentsystems = System::orderBy('created_at', 'desc')->take(15)->get();
      return view('service', compact('tests', 'systemduefortest', 'recentphotos', 'recentsystems'));
    }

    public function serviceMetrics()
    {
      $quantityFireAlarm = System::where('system_type_id', 1)->count();
      $quantityCleanAgent = System::where('system_type_id', 2)->count();
      $quantityInertGas = System::where('system_type_id', 3)->count();
      $quantityDryChem = System::where('system_type_id', 4)->count();
      $quantityWetChem = System::where('system_type_id', 5)->count();
      $quantityAerosol = System::where('system_type_id', 6)->count();
      $quantityFireSrinklerWet = System::where('system_type_id', 7)->count();
      $quantityFireSrinklerDry = System::where('system_type_id', 8)->count();
      $quantityFireSrinklerPreaction = System::where('system_type_id', 9)->count();
      $quantityFireSrinklerDeluge = System::where('system_type_id', 10)->count();
      $quantityFireSrinklerFoam = System::where('system_type_id', 11)->count();
      $quantityFEX = System::where('system_type_id', 12)->count();
      $quantityLoCO2 = System::where('system_type_id', 13)->count();
      $quantityHiCO2 = System::where('system_type_id', 14)->count();
      $quantityAirSampling = System::where('system_type_id', 15)->count();
      $quantityHEF = System::where('system_type_id', 16)->count();
      $quantityWatermist = System::where('system_type_id', 17)->count();
      $quantityBackflow = System::where('system_type_id', 18)->count();
      return view('service.metrics', compact(
        'quantityFireAlarm',
        'quantityCleanAgent',
        'quantityInertGas',
        'quantityDryChem',
        'quantityWetChem',
        'quantityAerosol',
        'quantityFireSrinklerWet',
        'quantityFireSrinklerDry',
        'quantityFireSrinklerPreaction',
        'quantityFireSrinklerDeluge',
        'quantityFireSrinklerFoam',
        'quantityFEX',
        'quantityLoCO2',
        'quantityHiCO2',
        'quantityAirSampling',
        'quantityHEF',
        'quantityWatermist',
        'quantityBackflow'
        ));
    }

    public function docs()
    {
      return view('docs');
    }

    public function fleet()
    {
      return view('fleet');
    }

    public function team()
    {
      return view('team');
    }

    public function admin()
    {
      $states = DB::table('states')->get();
      return view('admin', compact('states'));
    }

}
