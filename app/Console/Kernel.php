<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
        $schedule->call(function () {
            $unpayedLeases = DB::select('select * from leases where payed_at IS NULL', array(1));
            foreach ($unpayedLeases as $unpayedLease) {
                $createdAt = strtotime($unpayedLease->created_at);
                $now = strtotime(now());
                $timeInMinutes = ($now - $createdAt) / 60;
                if ($timeInMinutes >= 15) {
                    $id = $unpayedLease->id;
                    DB::table('leases')->delete($id);
                }
            }
        })->everyMinute()->thenPing("https://cronhub.io/ping/cfaebfb0-8e61-11ea-b978-3bfb1d9cdf52");
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
