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
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BusinessManagementController;
use App\Http\Controllers\Admin\CommissionHistoryController as AdminCommissionHistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CommissionPercentageController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\Admin\OttServiceController;
use App\Http\Controllers\Admin\PaypalCredentialController;
use App\Http\Controllers\Admin\StripeCredentialController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\AffiliateMarketer\CommissionHistoryController;
use App\Http\Controllers\AffiliateMarketer\WalletController;
use App\Http\Controllers\AffiliateMarketer\DashboardController as AffiliateMarketerDashboardController;
use App\Http\Controllers\AffiliateMarketer\ProfileController as AffiliateMarketerProfileController;
use App\Http\Controllers\AffiliateMarketer\ForgotPasswordController as AffiliateMarketerForgotPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaypalController;
use App\Http\Controllers\Frontend\SubscriptionController as FrontendSubscriptionController;
use App\Http\Controllers\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\SubscriptionController as CustomerSubscriptionController;
use App\Http\Controllers\Customer\ForgotPasswordController as CustomerForgotPasswordController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\PaymentDetailMailController;
use App\Http\Controllers\Admin\ManagerPermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\WalletController as AdminWalletcontroller;
use App\Http\Controllers\Captcha\RefreshCaptchaController;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Artisan;

// Clear cache
Route::get('clear', function () {
    Artisan::call('optimize:clear');
    return "Optimize clear has been successfully";
});

Route::get('reminder-mail-for-plan-expiry', function () {
    Artisan::call('reminder:mail');
    return "Reminder mail has been successfully";
});

Route::get('renwal-subscription', function () {
    Artisan::call('renewal:subscription');
    return "Renawal subscription has been successfully";
});

/* ----------------- Frontend Routes -----------------*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/refresh-captcha', [RefreshCaptchaController::class, 'refreshCaptcha'])->name('refresh.captcha');
// affliate authentication


Route::post('forget-password', [ForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('change-password', [ForgotPasswordController::class, 'changePassword'])->name('change.password');
Route::get('forget-password/show', [ForgotPasswordController::class, 'forgetPasswordShow'])->name('forget.password.show');
Route::get('reset-password/{id}/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

Route::get('/any-user/logout', [AuthController::class, 'anyUserLogout'])->name('any-user.logout');

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
Route::post('/check-payments-email', [PaypalController::class, 'checkPaymentsEmail'])->name('payments.email-check');
Route::get('/create-payments/{id}', [PaypalController::class, 'createPayments'])->name('create-payments');
Route::post('/process-payments', [PaypalController::class, 'processPayments'])->name('process-payments');
Route::get('/success-payment', [PaypalController::class, 'successPayment'])->name('success-payment');
Route::get('/cancel-payments', [PaypalController::class, 'cancelPayments'])->name('cancel-payments');
Route::get('/successPayment',[PaypalController::class, 'paymentSuccess'])->name('payment.successful');
Route::post('/capturePayment',[PaypalController::class, 'paymentcapture'])->name('paypal-capture-payment');
Route::post('/paypal-payment/{ord?}', [PaypalController::class, 'paypalPayment'])->name('paypal-payment');
Route::get('/paypal-success-payment/{pay?}/{pyr?}', [PaypalController::class, 'paypalSuccessPayment'])->name('paypal-success-payment');
Route::get('/paypal-pay-failed/{err?}',[PaypalController::class, 'paypalPayFailed'])->name('paypal-pay-failed');
Route::post('payment-type-check', [PaypalController::class, 'paymentTypeCheck'])->name('payments.payment-type-check');
// paypal.success.payment
Route::get('/paypal-success-payment-recurring', [PaypalController::class, 'paypalSuccessPaymentRecurring'])->name('paypal.success.payment');
//paypal.pay.failed
Route::get('/paypal-pay-failed-recurring', [PaypalController::class, 'paypalPayRecurringFailed'])->name('paypal.pay.failed');
Route::post('payment-validate', [PaypalController::class, 'paymentsValidate'])->name('payments.validate');
Route::get('/paypal-thank-you', [PaypalController::class, 'thankYou'])->name('paypal.thank-you');
//stripe recurring payment
Route::post('/create-subscription', [FrontendSubscriptionController::class, 'createSubscription'])->name('create-subscription');
Route::get('/success-subscription',[FrontendSubscriptionController::class, 'successSubscription'])->name('success-subscription');
Route::get('/failed-subscription',[FrontendSubscriptionController::class, 'failedSubscription'])->name('failed-subscription');


// coupon check
Route::post('/coupon-check', [PaypalController::class, 'couponCheck'])->name('coupon-check');
Route::post('/coupon-list', [FrontendSubscriptionController::class, 'couponList'])->name('coupon-list');
// affliate authentication
Route::name('affiliate-marketer.')
    ->prefix('affiliate-marketer')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register-store', [AuthController::class, 'registerStore'])->name('register.store');
        Route::post('/user-login-check', [AuthController::class, 'loginCheck'])->name('login.check');
        Route::get('forget-password/show', [AffiliateMarketerForgotPasswordController::class, 'forgetPasswordShow'])->name('forget-password.show');
        Route::post('forget-password', [AffiliateMarketerForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
        Route::get('reset-password/{id}/{token}', [AffiliateMarketerForgotPasswordController::class, 'resetPassword'])->name('reset.password');
        Route::post('change-password', [AffiliateMarketerForgotPasswordController::class, 'changePassword'])->name('change.password');

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
            Route::get('/wallet', [WalletController::class, 'walletList'])->name('wallet.list');
            Route::get('/wallet-history-fetch-data', [WalletController::class, 'walletFetchData'])->name('wallet.fetch-data');
            Route::get('/commission-history-fetch-data', [CommissionHistoryController::class, 'fetchData'])->name('commission-history.fetch-data');

            // payment transfer
            Route::get('/payment-transfer', [WalletController::class, 'paymentTransfer'])->name('payment.transfer');
            // redirect
            Route::get('/redirect', [WalletController::class, 'redirect'])->name('redirect');
            // wallet-money-transfer
            Route::get('/money-transfer-list', [WalletController::class, 'walletMoneyTransferList'])->name('wallet.money-transfer.list');
            // money-transfer-fetch-data
            Route::get('/money-transfer-fetch-data', [WalletController::class, 'walletMoneyTransferFetchData'])->name('wallet.money-transfer.fetch-data');
            Route::post('/money-transfer', [WalletController::class, 'walletMoneyTransfer'])->name('wallet.money-transfer');
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

        Route::post('cutomer-payment',[AdminPaymentController::class, 'customerPayment'])->name('customer.payment');

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
            'commission-percentage' => CommissionPercentageController::class,
            'ott-service' => OttServiceController::class,
            'managers' =>ManagerController::class,
            'users' => UserController::class,
            'emails' => EmailTemplateController::class
        ]);

        Route::get('/emails-fetch-data', [EmailTemplateController::class, 'fetchEmailseData'])->name('emails.ajax.list');

        Route::get('/delete-users/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
        Route::post('/update-users', [UserController::class, 'updateUser'])->name('update.users');

        Route::get('/customers',[AdminCustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers-plans/{id}', [AdminCustomerController::class, 'showPlans'])->name('customers.plans.show');
        Route::get('/customers-ajax-list', [AdminCustomerController::class, 'customerAjaxList'])->name('customers.ajax.list');
        Route::get('/customer-change-status', [AdminCustomerController::class, 'changeStatus'])->name('customers.change-status');
        Route::get('/customers/create',[AdminCustomerController::class, 'create'])->name('customers.create');
        Route::post('/customers/store',[AdminCustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/edit/{id}',[AdminCustomerController::class, 'editDetail'])->name('customers.edit-detail');
        Route::get('/customers/delete/{id}',[AdminCustomerController::class, 'deleteDetail'])->name('customers.delete-detail');
        Route::post('/customers/update',[AdminCustomerController::class, 'updateDetail'])->name('customers.update-deatil');
        Route::get('/customers/recharge-code/{id}',[AdminCustomerController::class, 'rechargeMail'])->name('customers.recharge-code-mail');
        Route::post('/customers/recharge-code',[AdminCustomerController::class, 'rechargeCodeMailSend'])->name('customers.recharge-code-send');
        Route::post('/customers/delete-multiple', [AdminCustomerController::class, 'deleteMultiple'])->name('customers.delete-multiple');


        Route::get('/manager-permission', [ManagerPermissionController::class, 'index'])->name('manager-permission.index');
        Route::get('/manager-permission-create', [ManagerPermissionController::class, 'permissionCreate'])->name('manager-permission.create');
        Route::post('/manager-permission-submit', [ManagerPermissionController::class, 'permissionSubmit'])->name('manager-permission.submit');
        Route::get('/manager-permission-edit/{id}', [ManagerPermissionController::class, 'permissionEdit'])->name('manager-permission.edit');
        Route::post('/manager-permission-update/{id}', [ManagerPermissionController::class, 'permissionUpdate'])->name('manager-permission.update');
        Route::get('/manager-permission-ajax-list', [ManagerPermissionController::class, 'permissionAjaxList'])->name('manager-permission.ajax.list');
        Route::get('/managers-ajax-list', [ManagerController::class, 'managerAjaxList'])->name('managers.ajax.list');
        //change status
        Route::get('/manager-change-status', [ManagerController::class, 'changeStatus'])->name('managers.change-status');
        //delete managers
        Route::get('/manager-delete/{id}', [ManagerController::class, 'managerDelete'])->name('managers.delete');

        //menu management route
        Route::get('/menu-management-fetch-data', [MenuManagementController::class, 'fetchDataMenu'])->name('menu-management.ajax.list');
        Route::post('/menu-management/update-menu', [MenuManagementController::class, 'menuUpdate'])->name('admin.menu-management.update'); // menu update
        Route::post('/menu-management/reorder-menu', [MenuManagementController::class, 'menuReorder'])->name('admin.menu-management.reorder'); // menu reorder
        Route::get('/menu-management/delete-menu/{id}', [MenuManagementController::class, 'menuDelete'])->name('delete.menu-managemnt'); // menu delete
        Route::post('/menu-management/status-change', [MenuManagementController::class, 'menuStatus'])->name('menu-management.changeStatus'); // menu status

        //ott service route
        Route::get('/delete-ott-service/{id}', [OttServiceController::class, 'deleteOttService'])->name('delete.ott-service');
        Route::get('/ott-service-fetch-data', [OttServiceController::class, 'fetchOttServiceData'])->name('ott-service.ajax.list');
        Route::post('/ott-service-update', [OttServiceController::class, 'updateOttService'])->name('update.ott-service');

        //plan management route
        Route::get('/plan-fetch-data', [PlanController::class, 'fetchPlanData'])->name('plan.ajax.list');
        Route::get('/commission-history-fetch-data', [AdminCommissionHistoryController::class, 'fetchData'])->name('commission-history.ajax-fetch-data');

        //commission percentage route
        Route::get('/commission-percentage-delete/{id}', [CommissionPercentageController::class, 'deletePercentage'])->name('delete.commission-percentage');
        Route::post('/commission-percentage-update', [CommissionPercentageController::class, 'updatePercentage'])->name('update.commission-percentage');
        Route::get('/commission-percentage-fetch-data', [CommissionPercentageController::class, 'fetchCommissionPercentage'])->name('commission-percentage.ajax.list');


        //coupons route
        Route::get('/coupons-fetch-data', [CouponController::class, 'fetchCouponData'])->name('coupons.ajax.list');
        Route::get('/coupons/delete/{id}', [CouponController::class, 'deleteCoupon'])->name('delete.coupons');
        Route::post('/coupons/update', [CouponController::class, 'updateCoupon'])->name('update.coupons');

        //coupon status change
        Route::post('/coupons/status-change', [CouponController::class, 'couponStatus'])->name('coupon.changeStatus');

        Route::get('/affliate-marketer-list', [AffliateMarketerController::class, 'affliateMarketerAjaxList'])->name('affliate-marketer.ajax.list');
        Route::get('/affliate-marketer-change-status', [AffliateMarketerController::class, 'changeStatus'])->name('affliate-marketer.change-status');
        Route::prefix('affliate-marketer')->group(function () {
            Route::get('/affliate-marketer-delete/{id}', [AffliateMarketerController::class, 'delete'])->name('affliate-marketer.delete');
            Route::post('/affliate-marketer-delete', [AffliateMarketerController::class, 'deleteMultiple'])->name('affliate-marketer.delete-multiple');
        });

        //products ajax list
        Route::get('/products-ajax-list', [ProductController::class, 'productAjaxList'])->name('products.ajax.list');
        Route::get('/deleteProducts/{id}', [ProductController::class, 'deleteProduct'])->name('delete.products');
        Route::post('/topStatusProduct', [ProductController::class, 'changeProductTopStatus'])->name('product.top-status');
        Route::post('/popularStatusProduct', [ProductController::class, 'changePopularStatus'])->name('product.popular-status');
        Route::post('/unbeatableStatusProduct', [ProductController::class, 'changeUnbeatableStatus'])->name('product.unbeatable-status');
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

        Route::get('/plan/delete/{id}', [PlanController::class, 'planDelete'])->name('delete.plan'); // plan delete
        Route::post('/plan/reorder', [PlanController::class, 'planReorder'])->name('admin.plan.reorder'); // plan reorder
        Route::post('/plan/update', [PlanController::class, 'planUpdate'])->name('update.plan'); // plan update

        //wallet deatils routes
        Route::get('/wallet-list', [AdminWalletcontroller::class, 'walletList'])->name('wallets.list');
        Route::get('/wallet-fetch-data', [AdminWalletcontroller::class, 'walletFetchData'])->name('wallets.fetch-data');

        // admin wallet money transfer list
        Route::get('/wallet-money-transfer-list', [AdminWalletcontroller::class, 'adminWalletMoneyTransferList'])->name('wallet.money-transfer.list');
        // admin wallet money transfer fetch data
        Route::get('/wallet-money-transfer-fetch-data', [AdminWalletcontroller::class, 'adminWalletMoneyTransferFetchData'])->name('wallet.money-transfer.fetch-data');

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
            Route::get('/subscriptionCms', [CmsController::class, 'subcriptionCms'])->name('subscription-us.cms');
            Route::post('/subscriptionCms/update', [CmsController::class, 'subscriptionCmsUpdate'])->name('update.subscription-us');

            //footer cms
            Route::get('/footerCms', [CmsController::class, 'footerCms'])->name('footer.cms');
            Route::post('/footerCms/update', [CmsController::class, 'footerCmsUpdate'])->name('update.footer.cms');

            //contact details cms
            Route::get('/contact-details', [CmsController::class, 'contactDetailsCms'])->name('contact-details.cms');
            Route::post('/contactDetails/update', [CmsController::class, 'contactDetailsCmsUpdate'])->name('update.contact-details.cms');

            //delete grid image
            Route::post('/deleteGridImage', [CmsController::class, 'gridImageDelete'])->name('delete.grid-image');
            Route::post('/deleteOttIcon', [CmsController::class, 'ottIconDelete'])->name('delete.ott-icon');
            Route::post('/deleteEntertainmentImage', [CmsController::class, 'entImageDelete'])->name('delete.entertainment-image');
        });

        Route::group(['prefix' => 'faq'], function () {
            Route::get('/faq-payment', [FaqController::class, 'faqPayment'])->name('faq.payment');
            Route::post('/faqPayment/update', [FaqController::class, 'faqPaymentUpdate'])->name('faq.payment.update');

            Route::get('/faq-general', [FaqController::class, 'faqGeneral'])->name('faq.general');
            Route::post('/faqGeneral/update', [FaqController::class, 'faqGeneralUpdate'])->name('faq.general.update');

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
        Route::get('/subscriber-list', [SubscriptionController::class, 'subscriptionList'])->name('subscriber.list');
        Route::get('/subscriber-list/ajax', [SubscriptionController::class, 'subscriptionAjaxList'])->name('subscriber.ajax.list');

        Route::group(['prefix' => 'site-settings'], function () {
            Route::resources([
                'credentials' => PaypalCredentialController::class,

            ]);
            Route::get('/payment-details-mail', [PaymentDetailMailController::class, 'paymentDetailMail'])->name('payment-detail-mail.edit-detail');
            Route::post('/payment-details-mail-update', [PaymentDetailMailController::class, 'paymentDetailMailUpdate'])->name('payment-detail-mail.update');
            Route::get('/paypal-change-status', [PaypalCredentialController::class, 'changeStatus'])->name('credentials.change-status');
        });

        Route::get('/credentials-filter', [PaypalCredentialController::class, 'filter'])->name('credentials.filter');

    });
});

Route::name('customer.')
    ->prefix('customer')
    ->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'customerLogin'])->name('login');
        Route::get('/register', [CustomerAuthController::class, 'register'])->name('register');
        Route::post('/register-store', [CustomerAuthController::class, 'registerStore'])->name('register.store');
        Route::post('/user-login-check', [CustomerAuthController::class, 'loginCheck'])->name('login.check');

        Route::get('forget-password/show', [CustomerForgotPasswordController::class, 'forgetPasswordShow'])->name('forget-password.show');
        Route::post('forget-password', [CustomerForgotPasswordController::class, 'forgetPassword'])->name('forget.password');
        Route::get('reset-password/{id}/{token}', [CustomerForgotPasswordController::class, 'resetPassword'])->name('reset.password');
        Route::post('change-password', [CustomerForgotPasswordController::class, 'changePassword'])->name('change.password');


        Route::group(['middleware' => 'user'], function () {
            Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
            Route::get('/profile', [CustomerProfileController::class, 'customerProfile'])->name('profile');
            Route::post('/profile/update', [CustomerProfileController::class, 'customerProfileUpdate'])->name('profile.update');
            Route::get('/password', [CustomerProfileController::class, 'customerPassword'])->name('password');
            Route::post('/password/update', [CustomerProfileController::class, 'customerPasswordUpdate'])->name('password.update');
            Route::get('/logout', [CustomerAuthController::class, 'customerLogout'])->name('logout');

            Route::get('/subscriptions', [CustomerSubscriptionController::class, 'customerSubscription'])->name('subscription');
            Route::get('/subscriptions-fetch-data', [CustomerSubscriptionController::class, 'fetchSubscription'])->name('subscription.ajax-list');
            Route::get('/subscriptions-details/{id}', [CustomerSubscriptionController::class, 'customerSubscriptionDetail'])->name('subscription.show');
            Route::post('/subscription-change-status',[CustomerSubscriptionController::class, 'subscriptionChangeStatus'])->name('subscription.change-status');

        });

        Route::get('/my-family-cinema', [CustomerSubscriptionController::class, 'myFamilyCinema'])->name('myFamily-cinema');
    });



Route::get('/cronsStartToWorkEmailSend', function () {
    Artisan::call('send:mail');
    return true;
});

//view page call
Route::get('/user-panel', function()
{
    return view('user-panel');
});



