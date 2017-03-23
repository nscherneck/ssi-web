<?php
namespace App\Http\Controllers;

use DB;
use App\Site;
use App\Test;
use App\Photo;
use App\System;
use App\Customer;
use App\Document;
use App\Component;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function home()
    {
        $activityItems = Activity::with(['causer', 'subject'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();  
        $recentphotos = Photo::orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $recentcomponentdocs = Document::orderBy('created_at', 'desc')
            ->where('documentable_type', 'App\Component')
            ->take(25)
            ->get();        
        $recentcomponents = Component::orderBy('created_at', 'desc')
            ->take(25)
            ->get();
        
        return view('home.show', compact(
            'activityItems', 
            'recentphotos', 
            'recentcomponentdocs', 
            'recentcomponents'
            )
        );
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
        $customers = Customer::orderBy('name')->get();
        $tests = Test::orderBy('test_date', 'desc')
            ->take(100)
            ->get();

        // systems due for test
        $start_date_raw = Carbon::now('America/Los_Angeles')->startOfMonth();
        $start_date = $start_date_raw
            ->subMonth()
            ->toDateString();
        $end_date = $start_date_raw->addMonthsNoOverflow(3)
            ->endOfMonth()
            ->toDateString();
        
        // metrics
        $systemduefortest = System::orderBy('next_test_date', 'asc')
            ->where('next_test_date', '!=', NULL)
            ->whereBetween('next_test_date', [$start_date, $end_date])
            ->get();
        
        // total systems donut chart
        $quantityTotal = System::count();
        
        $quantitySystemType = [];
        for($a = 1; $a <= 18; $a++) {
            $quantitySystemType[] = System::where('system_type_id', $a)->count();
        }
        
        // tests by month, trailing 12 bar chart
        $testsTotalTrailingTwelve = [];
        for($b = 0; $b <= 11; $b++){
            $start_now = Carbon::now('America/Los_Angeles');
            $end_now = Carbon::now('America/Los_Angeles');
            
            $start_date = $start_now->subMonthsNoOverflow($b)
                ->startOfMonth()
                ->toDateString();
            
            if($b === 0) {
                $end_date = $end_now
                    ->endOfMonth()
                    ->toDateString();
            } else {
                $end_date = $end_now
                    ->subMonthsNoOverflow($b)
                    ->endOfMonth()
                    ->toDateString();
            }
            
            $testsTotalTrailingTwelve[] = Test::orderBy('test_date', 'desc')
                ->whereBetween('test_date', [$start_date, $end_date])
                ->count();
        }
        
        $recentsystems = System::orderBy('created_at', 'desc')
            ->take(15)
            ->get();
        
        return view('service', compact(
            'customers',
            'tests',
            'systemduefortest',
            'recentsystems',
            'quantityTotal',
            'quantitySystemType',
            'testsTotalTrailingTwelve'
            )
        );
    }
    
    public function docs()
    {
        return view('docs');
    }
    
    public function admin()
    {
        $states = DB::table('states')->get();
        return view('admin', compact('states'));
    }

}
