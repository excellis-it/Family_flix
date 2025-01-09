<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Mail\RenewalMail;
use App\Models\User;
use App\Traits\PayPalTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Subscription;

class RenewalSubscription extends Command
{
    use PayPalTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewal:subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renewal subscription';

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
        // Fetch customers with their last subscription and order by ID in descending order
        $customers = User::with('userLastSubscription')->role('CUSTOMER')->orderBy('id', 'desc')->get();

        foreach ($customers as $customer) {
            $last_subscription = $customer->userLastSubscription;

            Log::info("Processing customer: {$customer->name}");

            if ($last_subscription) {
                $current_date = now()->format('Y-m-d');
                $expiry_date = optional($last_subscription)->plan_expiry_date
                    ? date('Y-m-d', strtotime($last_subscription->plan_expiry_date))
                    : null;

                if ($expiry_date && $expiry_date < $current_date) {
                    $paypal_subscription_id = $last_subscription->paypal_subscription_id ?? null;

                    if ($paypal_subscription_id) {
                        try {
                            // Fetch subscription details from PayPal
                            $subscriptionDetails = $this->getSubscriptionDetails($paypal_subscription_id);

                            // Log::info("PayPal subscription details fetched for customer {$subscriptionDetails}: {$paypal_subscription_id}");
                            // dd($subscriptionDetails);
                            if ($subscriptionDetails['status'] === 'ACTIVE') {
                                // Extend expiry date by 30 days
                                $new_expiry_date = now()->addDays(30)->format('Y-m-d');
                                $last_subscription->plan_expiry_date = $new_expiry_date;
                                $last_subscription->save();

                                $admin_email = 'amairmiller24@gmail.com';
                                // Send renewal email notification (commented for now)
                                // Mail::to($admin_email)->send(new RenewalMail($customer, $new_expiry_date));

                                Log::info("Renewal subscription for customer {$customer->name} has been updated to {$new_expiry_date}.");
                                $this->info("Renewal subscription for customer {$customer->name} has been updated.");
                            } else {
                                Log::warning("Subscription for customer {$customer->name} is not active on PayPal.");
                                $this->warn("Subscription for customer {$customer->name} is not active on PayPal.");
                            }
                        } catch (\Exception $e) {
                            Log::error("Error checking subscription for customer {$customer->name}: {$e->getMessage()}");
                            $this->error("Error checking subscription for customer {$customer->name}: {$e->getMessage()}");
                        }
                    } else {
                        Log::warning("No PayPal subscription ID found for customer {$customer->name}.");
                    }
                }
            } else {
                Log::info("No active subscription found for customer {$customer->name}.");
            }
        }
    }
}
