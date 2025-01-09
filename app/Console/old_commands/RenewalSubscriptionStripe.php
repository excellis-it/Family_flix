<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Mail\RenewalMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Subscription;

class RenewalSubscriptionStripe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewal:subscription:stripe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $customers = User::with('userLastSubscription')->role('CUSTOMER')->orderBy('id', 'desc')->get();

        foreach ($customers as $key => $customer) {
            $last_subscription = $customer->userLastSubscription;

            if ($last_subscription) {
                $current_date = date('Y-m-d');
                $expiry_date = date('Y-m-d', strtotime($last_subscription->plan_expiry_date)); // Ensure expiry_date is the correct column name

                if ($expiry_date < $current_date) {
                    // Initialize Stripe API with your secret key
                    $stripe = Helper::stripeCredential();
                    if (!empty($stripe->stripe_secret)) {
                        Stripe::setApiKey($stripe->stripe_secret);
                    } else {
                        // Handle missing secret key
                        throw new \Exception('Stripe secret key is missing');
                    }


                    $stripe_subscription_id = $last_subscription->stripe_subscription_id;

                    try {
                        // Fetch subscription status from Stripe
                        $stripe_subscription = Subscription::retrieve($stripe_subscription_id);

                        if ($stripe_subscription->status === 'active') {
                            // Update the expiry date in your database
                            $new_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($expiry_date)));

                            $last_subscription->plan_expiry_date = $new_expiry_date;
                            $last_subscription->save();
                            $admin_email = 'amairmiller24@gmail.com';
                            // $admin_email = 'swarnadwip@excellisit.net';
                            Mail::to($admin_email)->send(new RenewalMail($customer, $new_expiry_date));
                            Log::info('Renewal subscription for customer ' . $customer->name . ' has been updated.');
                            $this->info('Renewal subscription for customer ' . $customer->name . ' has been updated.');
                        } else {
                            Log::info('Subscription for customer ' . $customer->name . ' is not active on Stripe.');
                            $this->info('Subscription for customer ' . $customer->name . ' is not active on Stripe.');
                        }
                    } catch (\Exception $e) {
                        Log::error('Error checking subscription for customer ' . $customer->name . ': ' . $e->getMessage());
                        $this->error('Error checking subscription for customer ' . $customer->name . ': ' . $e->getMessage());
                    }
                }
            }
        }
    }
}
