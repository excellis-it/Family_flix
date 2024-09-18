<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\SubscriptionExpiryMail;
use App\Models\User;
use App\Models\UserSubscription;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

     protected $commands = [
        Commands\SendMail::class,
    ];
     

    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //    $customer = UserSubscription::with('customer')->where('plan_expiry_date', now()->addDays(4))->get();
        //     foreach ($customer as $key => $value) {
        //         \Mail::to($value->customer->email)->send(new SubscriptionExpiryMail($value));
        //     }
        // })->daily();

        // after 2 min of the schedule
        $schedule->command('mail:send')->everyMinute()->after(function () {
            // $customers = UserSubscription::orderBy('id','desc')->get();
            // foreach ($customers as $key => $value) {
            //     \Mail::to($value->customer->email)->send(new SubscriptionExpiryMail($value));
            // }
            \Mail::to('shreeja@yopmail.com')->send(new SubscriptionExpiryMail(UserSubscription::find(1)));

        });
        
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
