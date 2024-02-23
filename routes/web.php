<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AffliateMarketerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SiteManagementController;
use App\Http\Controllers\Admin\MenuManagementController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\GeneralCmsController;
use App\Http\Controllers\Admin\EntertainmentBannerController;
use App\Http\Controllers\Admin\TopGridController;
use App\Http\Controllers\Admin\BusinessManagementController;
use App\Http\Controllers\Admin\CommissionHistoryController as AdminCommissionHistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\AffiliateMarketer\CommissionHistoryController;
use App\Http\Controllers\AffiliateMarketer\DashboardController as AffiliateMarketerDashboardController;
use App\Http\Controllers\AffiliateMarketer\ProfileController as AffiliateMarketerProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaypalController;

use Illuminate\Support\Facades\Artisan;

// Clear cache
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return "Optimize clear has been successfully";
});

/* ----------------- Frontend Routes -----------------*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin.login');
// affliate authentication


Route::post('forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('change-password', [ForgotPasswordController::class, 'changePassword'])->name('change.password');
Route::get('forget-password/show', [ForgotPasswordController::class, 'forgetPasswordShow'])->name('forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::get('/about', [HomeController::class, 'aboutUs'])->name('about');
Route::get('/movies', [HomeController::class, 'movies'])->name('movies');
Route::get('/shows', [HomeController::class, 'shows'])->name('shows');
Route::get('/kids', [HomeController::class, 'kids'])->name('kids');
Route::get('/pricing/{id?}', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('/submit-Contact-us', [HomeController::class, 'contactSubmit'])->name('contact-us.submit');
Route::post('/submit-subscription', [HomeController::class, 'subscriptionSubmit'])->name('subscribe.submit');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/term-service', [HomeController::class, 'termService'])->name('term-service');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');


//payments
Route::get('/create-payments/{id}', [PaypalController::class, 'createPayments'])->name('create-payments');
Route::post('/process-payments', [PaypalController::class, 'processPayments'])->name('process-payments');
Route::get('/success-payment', [PaypalController::class, 'successPayment'])->name('success-payment');
Route::get('/cancel-payments', [PaypalController::class, 'cancelPayments'])->name('cancel-payments');

Route::get('/successPayment',[PaypalController::class, 'paymentSuccess'])->name('payment.successful');

// coupon check
Route::post('/coupon-check', [PaypalController::class, 'couponCheck'])->name('coupon-check');


// affliate authentication
Route::name('affiliate-marketer.')
    ->prefix('affiliate-marketer')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register-store', [AuthController::class, 'registerStore'])->name('register.store');
        Route::post('/user-login-check', [AuthController::class, 'loginCheck'])->name('login.check');

        // middleware for affliate-marketer
        Route::group(['middleware' => 'AffiliateMarketer'], function () {
            Route::get('/logout', [AuthController::class, 'affliateLogout'])->name('logout');
            Route::get('/profile', [AffiliateMarketerProfileController::class, 'index'])->name('profile');
            Route::post('/profile/update', [AffiliateMarketerProfileController::class, 'profileUpdate'])->name('profile.update');
            Route::get('/password', [AffiliateMarketerProfileController::class, 'password'])->name('password');
            Route::post('/password/update', [AffiliateMarketerProfileController::class, 'passwordUpdate'])->name('password.update');
            Route::get('/dashboard', [AffiliateMarketerDashboardController::class, 'index'])->name('dashboard');

            Route::resources([
                'commission-history' => CommissionHistoryController::class,
            ]);

            Route::get('/commission-history-fetch-data', [CommissionHistoryController::class, 'fetchData'])->name('commission-history.fetch-data');
        });
    });

/* ----------------- Admin Routes -----------------*/



Route::group(['prefix' => 'admin'], function () {
    Route::post('/login-check', [AdminController::class, 'loginCheck'])->name('admin.login.check');
    Route::group(['middleware' => 'admin'], function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::prefix('password')->group(function () {
            Route::get('/', [ProfileController::class, 'password'])->name('admin.password');
            Route::post('/update', [ProfileController::class, 'passwordUpdate'])->name('admin.password.update'); // password update
        });

        Route::resources([
            'menu-management' => MenuManagementController::class,
            'plan' => PlanController::class,
            'entertainment-banner' => EntertainmentBannerController::class,
            'top-grid' => TopGridController::class,
            'products' => ProductController::class,
            'coupons' => CouponController::class,
            'affliate-marketer' => AffliateMarketerController::class,
            'commission-history' => AdminCommissionHistoryController::class,
        ]);

        Route::get('/commission-history-fetch-data', [AdminCommissionHistoryController::class, 'fetchData'])->name('commission-history.fetch-data');

        //coupons route
        Route::get('/coupons/delete/{id}', [CouponController::class, 'deleteCoupon'])->name('delete.coupons');
        Route::post('/coupons/update', [CouponController::class, 'updateCoupon'])->name('update.coupons');

        Route::post('/affliate-marketer-list', [AffliateMarketerController::class, 'affliateMarketerAjaxList'])->name('affliate-marketer.ajax.list');
        Route::get('/affliate-marketer-change-status', [AffliateMarketerController::class, 'changeStatus'])->name('affliate-marketer.change-status');
        Route::prefix('affliate-marketer')->group(function () {
            Route::get('/affliate-marketer-delete/{id}', [AffliateMarketerController::class, 'delete'])->name('affliate-marketer.delete');
        });

        //products ajax list
        Route::get('/products-ajax-list', [ProductController::class, 'productAjaxList'])->name('products.ajax.list');
        Route::get('/deleteProducts/{id}', [ProductController::class, 'deleteProduct'])->name('delete.products');
        Route::post('/topStatusProduct', [ProductController::class, 'changeProductTopStatus'])->name('product.top-status');
        Route::post('/popularStatusProduct', [ProductController::class, 'changePopularStatus'])->name('product.popular-status');
        Route::post('/updateProduct', [ProductController::class, 'updateProducts'])->name('update.products');

        Route::get('/entertainment-banner/delete/{id}', [EntertainmentBannerController::class, 'deleteEntertainmentBanner'])->name('delete.entertainment-banner');
        Route::post('/entertainment-banner/update', [EntertainmentBannerController::class, 'updateEntertainmentBanner'])->name('update.entertainment-banner');
        //entertainment banner ajax list
        Route::get('/entertainment-banner-list', [EntertainmentBannerController::class, 'entertainmentBannerAjaxList'])->name('entertainment-banner.ajax.list');

        //top grid ajax list
        Route::get('/top-grid-list', [TopGridController::class, 'topGridAjaxList'])->name('top-grid.ajax.list');
        Route::get('/top-grid/delete/{id}', [TopGridController::class, 'deleteTopGrid'])->name('delete.top-grid');
        Route::post('/top-grid/update', [TopGridController::class, 'updateTopGrid'])->name('update.top-grid');


        Route::prefix('content-management')->group(function () {
            Route::get('/privacy-policy', [ContentManagementController::class, 'privacyPolicy'])->name('content-management.privacy-policy');
        });

        Route::post('/menu-management/update-menu', [MenuManagementController::class, 'menuUpdate'])->name('admin.menu-management.update'); // menu update
        Route::post('/menu-management/reorder-menu', [MenuManagementController::class, 'menuReorder'])->name('admin.menu-management.reorder'); // menu reorder
        Route::get('/menu-management/delete-menu/{id}', [MenuManagementController::class, 'menuDelete'])->name('delete.menu-managemnt'); // menu delete
        Route::post('/menu-management/status-change', [MenuManagementController::class, 'menuStatus'])->name('menu-management.changeStatus'); // menu status


        Route::get('/plan/delete/{id}', [PlanController::class, 'planDelete'])->name('delete.plan'); // plan delete
        Route::post('/plan/reorder', [PlanController::class, 'planReorder'])->name('admin.plan.reorder'); // plan reorder
        Route::post('/plan/update', [PlanController::class, 'planUpdate'])->name('update.plan'); // plan update


        Route::group(['prefix' => 'cms'], function () {
            //home cms
            Route::get('/home-cms', [CmsController::class, 'homeCms'])->name('home.cms');
            Route::post('/homeCms/update', [CmsController::class, 'homeCmsUpdate'])->name('home.cms.update');
            //plan cms
            Route::get('/plan-cms', [GeneralCmsController::class, 'planCms'])->name('plan.cms');
            Route::post('/planCms/update', [GeneralCmsController::class, 'planCmsUpdate'])->name('plan-cms.update');
            //kids cms
            Route::get('/kid-cms', [GeneralCmsController::class, 'kidCms'])->name('kid.cms');
            Route::post('/kidCms/update', [GeneralCmsController::class, 'kidCmsUpdate'])->name('kid-cms.update');
            //show cms
            Route::get('/show-cms', [GeneralCmsController::class, 'showCms'])->name('show.cms');
            Route::post('/showCms/update', [GeneralCmsController::class, 'showCmsUpdate'])->name('show-cms.update');
            //movie cms
            Route::get('/movie-cms', [GeneralCmsController::class, 'movieCms'])->name('movie.cms');
            Route::post('/movieCms/update', [GeneralCmsController::class, 'movieCmsUpdate'])->name('movie-cms.update');

            //contact-cms
            Route::get('/contact-cms', [GeneralCmsController::class, 'contactCms'])->name('contact.cms');
            Route::post('/contactCms/update', [GeneralCmsController::class, 'contactCmsUpdate'])->name('update.contact-us.cms');

            //entertainment cms
            Route::get('/entertainment-cms', [CmsController::class, 'entertainmentCms'])->name('entertainment.cms');
            Route::post('/entertainmentCms/update', [CmsController::class, 'entertainmentCmsUpdate'])->name('entertainment.cms.update');
            //about us cms
            Route::get('/about-cms', [CmsController::class, 'aboutCms'])->name('about.cms');
            Route::post('/aboutCms/update', [CmsController::class, 'aboutCmsUpdate'])->name('update.about-cms');

            //follow us cms
            Route::get('/follow-us', [CmsController::class, 'followCms'])->name('follow.cms');
            Route::post('/followCms/update', [CmsController::class, 'followCmsUpdate'])->name('update.follow-cms');

            //subscription cms
            Route::get('/subscription-us', [CmsController::class, 'subcriptionCms'])->name('subscription-us.cms');
            Route::post('/subscriptionCms/update', [CmsController::class, 'subscriptionCmsUpdate'])->name('update.subscription-us');

            //contact details cms
            Route::get('/contact-details', [CmsController::class, 'contactDetailsCms'])->name('contact-details.cms');
            Route::post('/contactDetails/update', [CmsController::class, 'contactDetailsCmsUpdate'])->name('update.contact-details.cms');

            //delete grid image
            Route::get('/deleteGridImage/{id}', [CmsController::class, 'gridImageDelete'])->name('delete.grid-image');
            Route::get('/deleteOttIcon/{id}', [CmsController::class, 'ottIconDelete'])->name('delete.ott-icon');
            Route::get('/deleteEntertainmentImage/{id}', [CmsController::class, 'entImageDelete'])->name('delete.entertainment-image');
        });

        Route::group(['prefix' => 'business-management'], function () {
            //faq management
            Route::get('/faq', [BusinessManagementController::class, 'faq'])->name('faq.management');
            Route::post('/faq/update', [BusinessManagementController::class, 'faqUpdate'])->name('faq.management.update');
            //privacy management
            Route::get('/privacy', [BusinessManagementController::class, 'privacy'])->name('privacy.management');
            Route::post('/privacy/update', [BusinessManagementController::class, 'privacyUpdate'])->name('privacy.management.update');
            //term management
            Route::get('/terms', [BusinessManagementController::class, 'terms'])->name('terms.management');
            Route::post('/terms/update', [BusinessManagementController::class, 'termsUpdate'])->name('terms.management.update');
        });

        //contact us list
        Route::get('/contact-us', [ContactUsController::class, 'contactList'])->name('contact-us.list');
        Route::get('/contact-us-list', [ContactUsController::class, 'contactAjaxList'])->name('contact-us.ajax.list');
        //subscriptions list
        Route::get('/subscription', [SubscriptionController::class, 'subscriptionList'])->name('subscription.list');
        Route::get('/subscription-list', [SubscriptionController::class, 'subscriptionAjaxList'])->name('subscription.ajax.list');
    });
});


Route::get('/cronsStartToWorkEmailSend', function () {
    Artisan::call('send:mail');
    return true;
});
