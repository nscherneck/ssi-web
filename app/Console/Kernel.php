<?php
namespace App\Console;

use App\Mail\WeeklyUpdate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            Mail::to('nathan.scherneck@gmail.com')->send(new WeeklyUpdate);
        })->weekly()
            ->mondays()
            ->timezone('America/Los_Angeles')
            ->at('6:00');

        $schedule->command('backup:clean')->daily()->at('01:00');

        $schedule->command('backup:run')->daily()->at('02:00');

        $schedule->command('backup:monitor')->daily()->at('03:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
