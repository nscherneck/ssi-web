<?php
namespace App\Http\Controllers;

use App\Customer;
use App\Site;
use App\System;
use App\SystemType;
use App\Test;
use App\TestResult;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
            ->take(100)
            ->get();

        return view('home.show', compact('activityItems'));
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
        if (Cache::has('customers')) {
            $customers = Cache::get('customers');
            return 'Shit worked';
        }
        Cache::forever('customers', Customer::whereBetween('id', [1, 10])->get());
        $customers = Cache::get('customers');
        return $customers;
        // return view('jobs');
    }

    public function serviceHome()
    {
        $customers = Customer::orderBy('name')->get();

        $testResults = TestResult::orderBy('name')->get();

        $systemTypes = SystemType::orderBy('type')->get();

        $tests = Test::orderBy('test_date', 'desc')
            ->with('system.site.customer')
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

        $systemsDueForTest = System::orderBy('next_test_date', 'asc')
            ->with('site.customer', 'systemType')
            ->where('next_test_date', '!=', null)
            ->whereBetween('next_test_date', [$startDate, $endDate])
            ->get();

        return view(
            'service.home',
            compact(
                'customers',
                'testResults',
                'systemTypes',
                'tests',
                'systemsDueForTest'
            )
        );
    }

    public function serviceMetrics()
    {

        // tests by month, trailing 12 bar chart
        $testsTotalTrailingTwelve = [];
        for ($b = 0; $b <= 11; $b++) {
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

        $systemTypes = SystemType::orderBy('type')->with('systems')->get();

        $systems = System::get();

        return view(
            'service.metrics',
            compact(
                'testsTotalTrailingTwelve',
                'systemTypes',
                'systems'
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
