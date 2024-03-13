<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Affiliater\ProfileController;
use App\Http\Controllers\Api\Affiliater\CommissionController;


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

        Route::group(['middleware' => 'auth:api'], function () {
            Route::group(['prefix' => 'affiliater'], function () {
                Route::post('profile-details', [ProfileController::class, 'profileDetails']);  // profile details api
                Route::post('profile-update', [ProfileController::class, 'profileUpdate']);  // profile update api

                Route::group(['prefix' => 'commission'], function () {
                    Route::post('list', [CommissionController::class, 'commissionList']);  // commission details api
                });

                //affiliate link
                Route::post('create-link', [ProfileController::class, 'affiliateLink']);  // commission details api
          

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

    });

