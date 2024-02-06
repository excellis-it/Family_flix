<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SiteManagementController;
use App\Http\Controllers\Admin\MenuManagementController;
use App\Http\Controllers\ForgetPasswordController;
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





/* ----------------- Admin Routes -----------------*/

Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('admin.forget.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');
Route::get('forget-password/show', [ForgetPasswordController::class, 'forgetPasswordShow'])->name('admin.forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('change-password', [ForgetPasswordController::class, 'changePassword'])->name('admin.change.password');

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

        Route::resources([
            'menu-management' => MenuManagementController::class,
        ]);
        Route::post('/menuUpdate', [MenuManagementController::class, 'menuUpdate'])->name('admin.menu-management.update'); // password update
        
    });
});




Route::get('/cronsStartToWorkEmailSend', function () {
    Artisan::call('send:mail');
    return true;
});
