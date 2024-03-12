<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\GeneralController;

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
        
});

