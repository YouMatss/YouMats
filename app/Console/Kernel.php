<?php

namespace App\Console;

use App\Mail\NoticeExpirySubscribe;
use App\Models\Subscribe;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

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
        $schedule->command('sitemap:generate')->weekly();

        $increment = 2000;
        for($i = 0; $i <= 30000; $i += $increment) {
            $schedule->command('sitemap:products', [
                'start' => $i,
                'increment' => $increment
            ])->weekly();
        }

        $schedule->command('backup:run')->daily()->at('01:00');

        $schedule->call(function () {
            $subscribes = Subscribe::whereDate('expiry_date', '>=', now())->get();
            $now = Carbon::now();

            foreach ($subscribes as $subscribe) {
                $subscribe_expiry_date = Carbon::parse($subscribe->expiry_date);
                $diff = $subscribe_expiry_date->diffInDays($now);
                $vendor = Vendor::where('vendor_id', $subscribe->vendor_id)->first();
                if($diff < 3) {
                    Mail::to($vendor)->send(new NoticeExpirySubscribe($vendor, $diff));
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
