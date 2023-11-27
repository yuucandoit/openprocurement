<?php

namespace App\Console;

use App\Console\Commands\SendNotifikasiBOD;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // dd((new \ReflectionClass($schedule->command('test:send ')))->getMethods());
        //Send Notif WA
        // $schedule->command('send:notif')->twiceDaily(11,16);
        $schedule->command(SendNotifikasiBOD::class)->twiceDaily(11,15);
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
