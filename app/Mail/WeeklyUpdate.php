<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

use App\Customer;
use App\Site;
use App\System;
use App\Test;

class WeeklyUpdate extends Mailable
{
    use Queueable, SerializesModels;
    
    public $customers_added;
    public $sites_added;
    public $systems_added;
    public $reports_added;

    public function __construct()
    {
        
    }

    public function build()
    {
        $address = 'nathan@suppression.com';
        $name = 'Nathan Scherneck';
        $subject = 'Weekly Update from SSI-Extranet';
        
        $end_date_raw = Carbon::now('America/Los_Angeles');
        $end_date = $end_date_raw->format('Y-m-d');
        $start_date = $end_date_raw->subWeeks(1)->format('Y-m-d');
        
        $start_date_testing_raw = Carbon::now('America/Los_Angeles');
        $start_date_testing = $start_date_testing_raw->format('Y-m-d');
        $end_date_testing = $start_date_testing_raw
            ->addMonths(3)
            ->format('Y-m-d');
        
        $newcustomers = Customer::orderBy('created_at', 'desc')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        
        $newsites = Site::orderBy('created_at', 'desc')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        
        $newsystems = System::orderBy('created_at', 'desc')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        
        $newtests = Test::orderBy('test_date', 'desc')
            ->whereBetween('test_date', [$start_date, $end_date])
            ->get();
    
        $systemsduefortest = System::orderBy('next_test_date', 'asc')
            ->where('next_test_date', '!=', null)    
            ->whereBetween('next_test_date', [$start_date_testing, $end_date_testing])    
            ->get();    
    
        return $this->view('email.weeklyupdate', compact(
            'newcustomers', 
            'newsites', 
            'newsystems', 
            'newtests', 
            'systemsduefortest'
                )
            )    
            ->from($address, $name)    
            ->subject($subject);
    }

}
