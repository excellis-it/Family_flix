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

        <nav class="sidebar sidebar-1 scroll-sidebar card mb-4">
            <ul class="nav flex-column" id="nav_accordion">
                <li class="nav-item has-submenu {{ Request::is('affiliate-marketer/dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('affiliate-marketer.dashboard') }}"> <span>
                            <i class="ti ti-aperture"></i>
                        </span>Dashboard<span class="arrow-down"></span></a>
                </li>
                <li class="nav-item has-submenu {{ Request::is('affiliate-marketer/profile*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('affiliate-marketer.profile') }}"> <span>
                            <i class="ti ti-user"></i>
                        </span>Profile<span class="arrow-down"></span></a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"> <span>
                            <i class="ti ti-link"></i>
                        </span>Affiliate Link<span class="arrow-down"></span></a>
                </li>
                <li class="nav-item has-submenu">
                    <a class="nav-link {{ Request::is('affiliate-marketer/affliate-marketer*') ? 'active' : '' }}" href="#">
                        <span>
                            <i class="ti ti-percentage"></i>
                        </span>Affiliate Commission
                        <span class="arrow-down"><i id="icon" class="ti ti-chevron-right"></i></span>
                    </a>
                    <ul class="submenu collapse {{ Request::is('affiliate-marketer/commission-history*') ? 'show' : '' }}">
                        <li class="{{ Request::is('affiliate-marketer/commission-history*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('affiliate-marketer.commission-history.index') }}">Commission History</a>
                        </li>
                    </ul>
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
