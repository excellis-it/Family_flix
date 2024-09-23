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
        // Retrieve customers whose plan expires in 4 days
        $customers = UserSubscription::with('customer')
            ->where('plan_expiry_date', now()->addDays(4))
            ->get();
        
        Log::info('Customers found: ' . $customers->count());

        if ($customers->isEmpty()) {
            Log::info('No customers found with plan expiring in 4 days.');
            return;
        }

        // Send reminder emails
        foreach ($customers as $customer) {
            try {
                Mail::to($customer->customer->email)->send(new SubscriptionExpiryMail($customer));
                Log::info('Email sent to: ' . $customer->customer->email);
            } catch (\Exception $e) {
                Log::error('Failed to send email to: ' . $customer->customer->email . ' - Error: ' . $e->getMessage());
            }
        }

        $this->info('Reminder emails have been sent successfully.');
        return 0;
    }
}
