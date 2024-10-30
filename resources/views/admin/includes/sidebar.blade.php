<aside class="left-sidebar">

    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{route('home')}}" class="text-nowrap logo-img">
                <img src="{{ asset('admin_assets/images/logo.png') }}" class="dark-logo" alt="">
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->

        <nav class="sidebar sidebar-1 card mb-4">
            <div class="scroll-sidebar">
            <ul class="nav flex-column" id="nav_accordion">
                <li class="nav-item has-submenu {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"> <span>
                            <i class="ti ti-aperture"></i>
                        </span>Dashboard<span class="arrow-down"></span></a>
                </li>
                {{-- @if (Gate::check('Manage Affiliater'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/affliate-marketer*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>Affiliate Marketer<span class="arrow-down"></span></a>
                </li>
                @endif --}}

                @if(Gate::check('Manage Affiliater'))
                <li class="nav-item has-submenu {{ Request::is('admin/affliate-marketer*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('affliate-marketer.index') }}"> <span>
                            <i class="ti ti-users"></i>
                        </span>Affiliate Marketers<span class="arrow-down"></span></a>
                </li>
                @endif

                @if(Gate::check('Manage Customer'))
                <li class="nav-item has-submenu {{ Request::is('admin/customers*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.index') }}"> <span>
                            <i class="ti ti-users"></i>
                        </span>Customers<span class="arrow-down"></span></a>
                </li>
                @endif

                @if (Gate::check('Manage Manager'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }} {{ Request::is('admin/manager-permission*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-pencil"></i>
                        </span>Manager Permission
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/users*') ? 'show' : '' }} {{ Request::is('admin/manager-permission*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="{{ Request::is('admin/manager-permission*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('manager-permission.index') }}">Roles</a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- @if (Gate::check('Manage Permission'))
                <li class="nav-item has-submenu {{ Request::is('admin/manager-permission*') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{ route('manager-permission.index') }}"> <span>
                            <i class="ti ti-aperture"></i>
                        </span>Manager Permission<span class="arrow-down"></span></a>
                </li>
                @endif --}}
                {{-- <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/menu-management*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-category"></i>
                        </span>Menu management
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/menu-management*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/menu-management*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('menu-management.index') }}">List</a>
                        </li>
                    </ul>
                </li> --}}

                @if (Gate::check('Manage Plan'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/plan*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-box"></i>
                        </span>Plan management
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/plan*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/plan*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('plan.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Gate::check('Manage Product'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/products*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-movie"></i>
                        </span>Product
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/products*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('products.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Gate::check('Manage Commission'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/commission-percentage*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-arrow-right"></i>
                        </span>Commission Percentage
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/commission-percentage*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/commission-percentage*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('commission-percentage.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Gate::check('Manage Commission History'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/affliate-marketer*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-percentage"></i>
                        </span>Affiliate Commission
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/commission-history*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/commission-history*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('commission-history.index') }}">Commission History</a>
                        </li>
                    </ul>
                </li>
                @endif



                {{-- <li class="nav-item has-submenu {{ Request::is('admin/plan*') ? 'active' : '' }}">
                    <a class="nav-link {{ Request::is('admin/plan*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>Plan management
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/plan*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/plan*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('plan.index') }}">List</a>
                        </li>
                    </ul>
                </li> --}}

                @if (Gate::check('Manage Entertainment Banner'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/entertainment-banner*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-photo"></i>
                        </span>Entertainment banner
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/entertainment-banner*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/entertainment-banner*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('entertainment-banner.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Gate::check('Manage Top Grid'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/top-grid*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-category"></i>
                        </span>Top Grid
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/top-grid*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/top-grid*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('top-grid.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if (Gate::check('Manage Ott Platform'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/ott-service*') ? 'active' : ' ' }}" href="#">
                        <span>
                            <i class="ti ti-box"></i>
                        </span>OTT Icon
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/ott-service*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/ott-service*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('ott-service.index') }}">List</a>
                        </li>
                    </ul>
                </li>
                @endif





                @if(Gate::check('Manage Cms'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/cms*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>Site Setting
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/cms*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/home-cms*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home.cms') }}">Home</a>
                        </li>

                        <li class="{{ Request::is('admin/cms/plan-cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('plan.cms') }}">Plan</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/kid-cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('kid.cms') }}">Kids</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/show-cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('show.cms') }}">Show</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/movie-cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('movie.cms') }}">Movie</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/about.cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('about.cms') }}">About</a>
                        </li>

                        <li class="{{ Request::is('admin/cms/contact-cms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('contact.cms') }}">ContactUs</a>
                        </li>

                        <li class="{{ Request::is('admin/cms/contact-details*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('contact-details.cms') }}">Contact Details</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/follow-us*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('follow.cms') }}">Follow us</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/subscription-us*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('subscription-us.cms') }}">Subscription Us</a>
                        </li>
                        <li class="{{ Request::is('admin/cms/footerCms*') ? 'active' : ' ' }}">
                            <a class="nav-link" href="{{ route('footer.cms') }}">Footer cms</a>
                        </li>

                    </ul>
                </li>
                @endif

                @if(Gate::check('Business Management Cms'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/business-management*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>Business Management
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/business-management*') ? 'show' : '' }}">
                        {{-- <li class="{{ Request::is('admin/faq-management*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('faq.management') }}">Faq</a>
                        </li> --}}
                        <li class="{{ Request::is('admin/privacy-management*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('privacy.management') }}">Privacy Policy</a>
                        </li>
                        <li class="{{ Request::is('admin/terms-management*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('terms.management') }}">Term & Condition</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Gate::check('Faq Management'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/faq*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-table"></i>
                        </span>Faq Management
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/faq*') ? 'show' : '' }}">
                        {{-- <li class="{{ Request::is('admin/faq-management*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('faq.management') }}">Faq</a>
                        </li> --}}
                        <li class="{{ Request::is('admin/faq-payment*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('faq.payment') }}">Payment Page</a>
                        </li>
                        <li class="{{ Request::is('admin/faq-general*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('faq.general') }}">General Page</a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(Gate::check('View Contactus') || Gate::check('View Subscribers'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/contact-us*') || Request::is('admin/subscriber-list*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-phone"></i>
                        </span>Communications
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/contact-us*') || Request::is('admin/subscriber-list*')  ? 'show' : '' }}">
                        @if(Gate::check('View Contactus'))
                        <li class="{{ Request::is('admin/contact-us*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact-us.list') }}">Contact Us List</a>
                        </li>
                        @endif

                        @if(Gate::check('View Subscribers'))
                        <li class="{{ Request::is('admin/subscriber-list*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('subscriber.list') }}">Subscribers List</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif


                @if(Gate::check('Manage Coupon'))
                    <li class="nav-item has-submenu">
                        <a class="nav-link {{ Request::is('admin/coupons*') ? 'active' : '' }}" href="#">
                            <span>
                                <i class="ti ti-gift"></i>
                            </span>Coupons
                            <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="submenu collapse {{ Request::is('admin/coupons*') ? 'show' : '' }}">
                            <li class="{{ Request::is('admin/coupons*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('coupons.index') }}">List</a>
                            </li>
                        </ul>
                    </li>
                @endif

                
                @if(Gate::check('Manage Payment Detail'))
                    <li class="nav-item has-submenu">
                        <a class="nav-link {{ Request::is('admin/site-settings*') ? 'active' : '' }}" href="#">
                            <span>
                                <i class="fa fa-cog"></i>
                            </span>Payment Setting
                            <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                        </a>
                        <ul class="submenu collapse {{ Request::is('admin/site-settings*') ? 'show' : '' }}">
                            <li class="{{ Request::is('admin/site-settings/credentials*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('credentials.index') }}">Stripe Credentials</a>
                            </li>
                            <li class="{{ Request::is('admin/site-settings/payment-details-mail*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('payment-detail-mail.edit-detail') }}">Payment Detail Mail</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Gate::check('Manage Wallet'))
                    <li class="nav-item has-submenu">
                        <a class="nav-link {{ Request::is('admin/wallet-list*') ? 'active' : '' }}" href="#">
                            <span>
                                <i class="fa fa-money"></i>
                            </span>Wallet
                            <span class="arrow-down"><i id="icon" class="ti ti-wallet"></i></span>
                        </a>
                        <ul class="submenu collapse {{ Request::is('admin/wallet-list*') ? 'show' : '' }}">
                            <li class="{{ Request::is('admin/wallet-list*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('wallets.list') }}">Details</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->hasRole('ADMIN'))
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('admin/wallet-money-transfer-list*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-arrow-right"></i>
                        </span>Wallet Transfer History
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('admin/wallet-money-transfer-list*') ? 'show' : '' }}">
                        <li class="{{ Request::is('admin/wallet-money-transfer-list*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('wallet.money-transfer.list') }}">List</a>
                        </li>
                    </ul>
                </li>
            @endif
            </ul>
            </div>
        </nav>


        {{-- <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('admin/menu-management*') ? 'active' : '' }}">

                    <a class="sidebar-link" href="{{ route('menu-management.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">Menu</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('admin/plan*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('plan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Plan</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('admin/cms*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('home.cms') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Home Cms</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('admin/cms/plan-cms*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('plan.cms') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Plan Cms</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/cms/kid-cms*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('kid.cms') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Kid Cms</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/cms/show-cms*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('show.cms') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Show Cms</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/cms/movie-cms*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('movie.cms') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Movie Cms</span>
                    </a>
                </li>


                <li class="sidebar-item {{ Request::is('admin/contact-us*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('contact-us.list') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Contact Us</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('admin/subscription*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('subscription.list') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Subscription</span>
                    </a>
                </li>


            </ul>
        </nav> --}}
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="images/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                    <span class="fs-2 text-dark">Designer</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button"
                    aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
