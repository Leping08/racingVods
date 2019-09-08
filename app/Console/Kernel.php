<?php

namespace App\Console;

use App\Library\PotentialRaces\FindPotentialRaces;
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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Gather new races from youtube api
        $schedule->call(function () {
            FindPotentialRaces::handel();
        })->dailyAt('5:00');

        //Send new races report to admin
        $schedule->call(function () {
            FindPotentialRaces::sendReport();
        })->dailyAt('5:15');

        $schedule->call(function () {
            Log::info('Working!');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
