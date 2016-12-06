<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        return $this->view('email.weeklyupdate')
        ->from($address, $name)
        ->subject($subject);
    }
}
