<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Affiliater\ProfileController;
use App\Http\Controllers\Api\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Api\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Api\Customer\SubscriptionController as CustomerSubscriptionController;
use App\Http\Controllers\Api\Affiliater\CommissionController;
use App\Http\Controllers\Api\CouponCheckController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\Affiliater\DashboardController;
use App\Http\Controllers\Api\Affiliater\WalletController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::prefix('v1')->group(function () {

        Route::post('login', [AuthController::class, 'login']);  // login api
        Route::post('register', [AuthController::class, 'register']);  // register api
        Route::post('affiliater-forgot-password',[ForgotPasswordController::class, 'affiForgotPassword']);
        Route::post('customer-forgot-password',[ForgotPasswordController::class, 'customerForgotPassword']);

        Route::group(['middleware' => 'auth:api'], function () {
            Route::group(['prefix' => 'affiliater'], function () {
                Route::post('profile-details', [ProfileController::class, 'profileDetails']);  // profile details api
                Route::post('profile-update', [ProfileController::class, 'profileUpdate']);  // profile update api
                Route::post('dashboard', [DashboardController::class, 'dashboard']);  // dashboard api

                Route::group(['prefix' => 'wallet'], function () {
                    Route::post('list', [WalletController::class, 'walletList']);  // wallet details api
                });


                Route::group(['prefix' => 'commission'], function () {
                    Route::post('list', [CommissionController::class, 'commissionList']);  // commission details api
                });

                //affiliate link
                Route::post('create-link', [ProfileController::class, 'affiliateLink']);  // commission details api
            });
        });

        //user routes

        Route::group(['prefix' => 'customer'], function () {
            Route::post('register', [CustomerAuthController::class, 'customerRegister']);  // register api
            Route::post('login', [CustomerAuthController::class, 'customerLogin']);  // login api

            Route::group(['middleware' => 'auth:api'], function () {
                Route::post('account-details', [CustomerProfileController::class, 'accountDetails']);  // profile details api
                Route::post('account-update', [CustomerProfileController::class, 'accountUpdate']);  // profile update api
                Route::group(['prefix' => 'subscription'], function () {
                    // Route::post('create', [CustomerSubscriptionController::class, 'stripePaymentCreate']);
                    Route::post('list', [CustomerSubscriptionController::class, 'subscriptionList']);  // customer subscriptions api
                });

                Route::post('account-delete', [CustomerAuthController::class, 'customerDelete']);  // delete user api

            });
        });

        // Grouping CMS routes
        Route::prefix('cms')->group(function () {
            // Defining route for CMS home
            Route::post('home', [CmsController::class, 'homeCms']);
            Route::post('grid-section', [CmsController::class, 'gridSectionCms']);
            Route::post('about', [CmsController::class, 'aboutCms']);
            Route::post('contact', [CmsController::class, 'contactCms']);
            Route::post('pricing',[CmsController::class, 'pricingCms']);
            Route::post('faq',[CmsController::class, 'faqCms']);
            Route::post('privacy',[CmsController::class, 'privacyCms']);
            Route::post('terms',[CmsController::class, 'termConditions']);
            Route::post('contact-details',[CmsController::class, 'contactDetail']);
            Route::post('subscription',[CmsController::class, 'subscription']);
        });

        Route::prefix('product')->group(function () {
            Route::post('unbeatable-variety', [ProductController::class, 'unbeatableVariety']);
        });

        Route::prefix('plans')->group(function () {
            Route::post('show', [PlanController::class, 'planDetails']);
        });
        Route::prefix('show')->group(function () {
            Route::post('detail', [ProductController::class, 'showDetail']);
        });
        Route::prefix('movie')->group(function () {
            Route::post('detail', [ProductController::class, 'movieDetail']);
        });

        Route::prefix('kid')->group(function () {
            Route::post('detail', [ProductController::class, 'kidDetail']);
        });

        Route::post('contact-us', [GeneralController::class, 'contactUs']);
        Route::post('subscribe-us', [GeneralController::class, 'subscribeUs']);

        //payment gateway
        Route::post('coupon-check', [CouponCheckController::class, 'checkCoupon']);
        Route::post('coupon-list', [CouponCheckController::class, 'listCoupon']);
        Route::post('payment-capture', [PaymentController::class, 'paymentCapture']);
        Route::post('billing-address', [PaymentController::class, 'billingAddress']);


        Route::group(['prefix' => 'subscription-payment'], function () {
            // Route::post('credential', [CustomerSubscriptionController::class, 'stripePaymentCredential']);
            Route::post('credential', [CustomerSubscriptionController::class, 'paypalPaymentCredential']);
            Route::post('create', [CustomerSubscriptionController::class, 'stripePaymentCreate']);
        });

    });

