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

      // total systems donut chart
      $quantityTotal = System::count();

      $quantitySystemType = [];
      for($a = 1; $a <= 18; $a++) {
      $quantitySystemType[] = System::where('system_type_id', $a)->count();
      }

      // tests by month, trailing 12 bar chart
      $start_now = Carbon::now('America/Los_Angeles');
      $end_now = Carbon::now('America/Los_Angeles');
      $testsTotalTrailingTwelve = [];
      for($b = 0; $b <= 11; $b++){

        $start_date = $start_now->subMonths($b)->startOfMonth()->toDateString();

        if($b === 0)
        {
          $end_date = $end_now->endOfMonth()->toDateString();
        } else {
          $end_date = $end_now->subMonths($b)->endOfMonth()->toDateString();
        }

        $testsTotalTrailingTwelve[] = Test::orderBy('test_date', 'desc')
        ->whereBetween('test_date', [$start_date, $end_date])
        ->count();
      }

      return view('service.metrics', compact(
        'quantityTotal',
        'quantitySystemType',
        'testsTotalTrailingTwelve'
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
