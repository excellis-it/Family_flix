<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;

use Illuminate\Support\Facades\Artisan;

// Clear cache
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return "Optimize clear has been successfully";
});

/* ----------------- Frontend Routes -----------------*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/perks', [HomeController::class, 'perks'])->name('perks');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin.login');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-store', [AuthController::class, 'registerStore'])->name('register.store');
Route::post('/user-login-check', [AuthController::class, 'loginCheck'])->name('login.check');
Route::post('forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('change-password', [ForgotPasswordController::class, 'changePassword'])->name('change.password');
Route::get('forget-password/show', [ForgotPasswordController::class, 'forgetPasswordShow'])->name('forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::get('/pricing',[HomeController::class, 'pricing'])->name('pricing');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/help-center', [HomeController::class, 'helpCenter'])->name('help-center');
Route::get('/help-centers/details', [HomeController::class, 'helpCenterDetails'])->name('help-centers.get-details');
Route::get('/career', [HomeController::class, 'career'])->name('career');
Route::get('/career-details/{id}', [HomeController::class, 'careerDetails'])->name('career.details');
Route::get('/career-form/{id}', [HomeController::class, 'careerForm'])->name('career-form');


Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');


Route::get('/blog/{slug}', [HomeController::class, 'blogDetails'])->name('blog-details');
Route::post('/blog-comment',[HomeController::class, 'blogComment'])->name('blog.comment.submit');


Route::get('/our-work', [HomeController::class, 'ourWork'])->name('our.work');
Route::post('/our-work/filter',[HomeController::class, 'ourWorkFilter'])->name('our-work.filter');
Route::post('/plan/filter',[HomeController::class, 'pricingFilter'])->name('pricing.filter');
Route::post('/plan-checking',[HomeController::class, 'planChecking'])->name('plan.checking');


Route::post('/job-apply',[HomeController::class, 'JobApply'])->name('submit.job-apply');
Route::get('/services',[HomeController::class, 'services'])->name('services');



/* ----------------- Admin Routes -----------------*/

Route::group(['prefix' => 'admin'], function () {
    Route::post('/login-check', [AdminController::class, 'loginCheck'])->name('admin.login.check');
    Route::group(['middleware' => 'admin'], function () {

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout'); 

        Route::prefix('password')->group(function () {
            Route::get('/', [ProfileController::class, 'password'])->name('admin.password'); 
            Route::post('/update', [ProfileController::class, 'passwordUpdate'])->name('admin.password.update'); // password update
        });
        
    });
});




Route::get('/cronsStartToWorkEmailSend', function () {
    Artisan::call('send:mail');
    return true;
});
