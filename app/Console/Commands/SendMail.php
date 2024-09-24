<?php

namespace App\Console\Commands;

use App\Mail\InvoiceMail;
use App\Mail\SubscriptionExpiryMail;
use App\Models\File;
use App\Models\Invoice;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\UserSubscription;

use PDF;
class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends subscription expiry reminder emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = UserSubscription::with('customer')
        ->where('plan_expiry_date', Carbon::today()->addDays(4)->toDateString())
        ->get();
        
        Log::info('Customers found: ' . $customers->count());
    
        if ($customers->isEmpty()) {
            Log::info('No customers found with plan expiring in 4 days.');
            return;
        }
    
        // Send reminder emails
        foreach ($customers as $customer) {
            Log::info('Preparing to send email to: ' . $customer->customer->email);
            
            try {
                Mail::to($customer->customer->email)->send(new SubscriptionExpiryMail($customer));
                
                Log::info('Email sent successfully to: ' . $customer->customer->email);
            } catch (\Exception $e) {
                
                Log::error('Failed to send email to: ' . $customer->customer->email . ' - Error: ' . $e->getMessage());
    
                // Test sending a plain text email
                try {
                    Mail::raw('This is a test email to verify sending functionality.', function ($message) use ($customer) {
                        $message->to($customer->customer->email)
                                ->subject('Test Email');
                    });
                    Log::info('Test email sent successfully to: ' . $customer->customer->email);
                } catch (\Exception $testException) {
                    Log::error('Failed to send test email to: ' . $customer->customer->email . ' - Error: ' . $testException->getMessage());
                }
            }
        }
    }
}
