<?php

namespace App\Console;

use App\Models\Subscribe;
use Carbon\Carbon;
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
        $schedule->command('backup:run')->daily()->at('01:00');

        $schedule->call(function () {
            $subscribes = Subscribe::whereDate('expiry_date', '>=', now())->get();
            $now = Carbon::now();

            foreach ($subscribes as $subscribe) {
                $subscribe_expiry_date = Carbon::parse($subscribe->expiry_date);
                $diff = $subscribe_expiry_date->diffInDays($now);
                if($diff < 7) {
                    // Send Mail
                }
            }

        })->dailyAt('13:00');

    }

    protected function scheduleTimezone()
    {
        return 'Asia/Riyadh';
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
