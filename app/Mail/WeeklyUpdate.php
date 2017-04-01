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
 
        return $this->view('email.weeklyupdate')    
            ->from($address, $name)    
            ->subject($subject);
    }

}
