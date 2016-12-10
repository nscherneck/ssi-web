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

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $customers_added;
    public $sites_added;
    public $systems_added;
    public $reports_added;

    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $address = 'nathan@suppression.com';
      $name = 'Nathan Scherneck';
      $subject = 'Weekly Summary from SSI-Web';

      $end_date_raw = Carbon::now('America/Los_Angeles');
      $end_date = $end_date_raw->format('Y-m-d');
      $start_date = $end_date_raw->subWeeks(3)->format('Y-m-d');

      $newcustomers = Customer::orderBy('created_at', 'desc')
                ->whereBetween('created_at', [$start_date, $end_date])->get();

      $newsites = Site::orderBy('created_at', 'desc')
                ->whereBetween('created_at', [$start_date, $end_date])->get();

      $newsystems = System::orderBy('created_at', 'desc')
                ->whereBetween('created_at', [$start_date, $end_date])->get();

      $newtests = Test::orderBy('test_date', 'desc')
                ->whereBetween('test_date', [$start_date, $end_date])->get();

      $systemduefortest = System::orderBy('next_test_date', 'asc')->where('next_test_date', '!=', NULL)->take(50)->get();

        return $this->view('email.weeklyupdate', compact('newcustomers', 'newsites', 'newsystems', 'newtests', 'systemduefortest'))
        ->from($address, $name)
        ->subject($subject);
    }
}
