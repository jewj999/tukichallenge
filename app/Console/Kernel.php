<?php

namespace App\Console;

use App\Jobs\FetchSummonerMatchData;
use App\Jobs\FetchSummonersData;
use App\Jobs\FetchSummonersIds;
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
        $schedule->job(new FetchSummonersIds)->everyFiveMinutes();
        $schedule->job(new FetchSummonersData)->everyMinute();
        $schedule->job(new FetchSummonerMatchData)->everyThreeMinutes();
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
