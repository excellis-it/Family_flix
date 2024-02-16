<aside class="left-sidebar">

    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index.html" class="text-nowrap logo-img">
                <img src="{{ asset('admin_assets/images/logo.png') }}" class="dark-logo" alt="">
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                
                
                <li class="sidebar-item {{ Request::is('admin/menu-management*') ? 'active' : '' }}">
                    {{-- --}}
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
                

                <li class="sidebar-item {{ Request::is('admin/contact-us*') ? 'active' : ' ' }}">
                    <a class="sidebar-link" href="{{ route('contact-us.list') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-tag"></i>
                        </span>
                        <span class="hide-menu">Contact Us</span>
                    </a>
                </li>
            </ul>
        </nav>
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
