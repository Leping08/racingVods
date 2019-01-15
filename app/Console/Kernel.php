<?php

namespace App\Console;

use App\Library\FindPotentialRaces;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
//         $schedule->command('inspire')
//                  ->hourly();

        //Gather new races from youtube api
        $schedule->call(function() {
            (new FindPotentialRaces())->handel();
        })->dailyAt('5:00');

        //Send new races report to admin
        $schedule->call(function () {
            (new FindPotentialRaces())->sendReport();
        })->weekly()->tuesdays()->at('5:00');


        $schedule->call(function () {
            Log::info("The cron is working");
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
