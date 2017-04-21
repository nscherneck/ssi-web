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
    
    public function engineering()
    {
        return view('engineering');
    }
    
    public function jobs()
    {
        return view('jobs');
    }
    
    public function serviceHome()
    {
        $customers = Customer::orderBy('name')->get();
        $tests = Test::orderBy('test_date', 'desc')
            ->take(100)
            ->get();

        // systems due for test
        $startDateRaw = Carbon::now('America/Los_Angeles')->startOfMonth();
        $startDate = $startDateRaw
            ->subMonth()
            ->toDateString();
        $endDate = $startDateRaw->addMonthsNoOverflow(3)
            ->endOfMonth()
            ->toDateString();
        
        // metrics
        $systemduefortest = System::orderBy('next_test_date', 'asc')
            ->where('next_test_date', '!=', NULL)
            ->whereBetween('next_test_date', [$startDate, $endDate])
            ->get();
        
        return view('service.home', compact(
            'customers', 'tests', 'systemduefortest')
            );
    }    

    public function serviceMetrics()
    {
        
        // total systems donut chart
        $totalSystemsCount = System::count();
        
        $systemsCountByType = [];
        for ($a = 1; $a <= 18; $a++) {
            $systemsCountByType[] = System::where('system_type_id', $a)->count();
        }
        
        // tests by month, trailing 12 bar chart
        $testsTotalTrailingTwelve = [];
        for($b = 0; $b <= 11; $b++){
            
            $startDate = Carbon::now('America/Los_Angeles')->subMonthsNoOverflow($b)
                ->startOfMonth()
                ->toDateString();
            
            if ($b === 0) {
                $endDate = Carbon::now('America/Los_Angeles')->endOfMonth()
                    ->toDateString();
            } else {
                $endDate = Carbon::now('America/Los_Angeles')->subMonthsNoOverflow($b)
                    ->endOfMonth()
                    ->toDateString();
            }
            
            $testsTotalTrailingTwelve[] = Test::orderBy('test_date', 'desc')
                ->whereBetween('test_date', [$startDate, $endDate])
                ->count();
        }

        return view('service.metrics', compact(
            'totalSystemsCount',
            'systemsCountByType',
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
