<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\SubscriptionExpiryMail;
use App\Models\User;
use App\Models\UserSubscription;

class Kernel extends ConsoleKernel
{
    

    protected $commands = [
        \App\Console\Commands\SendMail::class, // Register the SendMail command
    ];
     

    protected function schedule(Schedule $schedule)
    {

        $schedule->command('reminder:mail')->daily();
        
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
