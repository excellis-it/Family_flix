
@php
use App\Helpers\Helper;
@endphp



<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>

        <div class="d-block d-lg-none">
            <img src="{{ asset('admin_assets/images/logo.png') }}" class="dark-logo" width="" alt="">
        </div>

        

        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

            <li class="nav-wallet">
                <a href="#" class="nav-wallet-link" title="View Wallet">
                  <i class="ti ti-wallet"></i>
                  <span class="wallet-amount">${{Helper::affiliatorWallet(Auth::user()->id) }}</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="user-profile-img">
                            @if (Auth::user()->image)
                                <img src="{{ Storage::url(Auth::user()->image) }}" alt="user"
                                    class="rounded-circle" width="35" height="35" alt="">
                            @else
                                <img src="{{ asset('admin_assets/images/user-1.jpg') }}" class="rounded-circle"
                                    width="35" height="35" alt="">
                            @endif

                        </div>
                    </div>
                </a>

                
        
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                    aria-labelledby="drop1">
                    <div class="profile-dropdown position-relative" data-simplebar="">
                        <div class="py-3 px-7 pb-0">
                            <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                        </div>
                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">


                        </div>
                        <div class="message-body">
                            <a href="{{route('affiliate-marketer.profile')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                    <img src="{{ asset('admin_assets/images/icon-account.svg') }}" alt=""
                                        width="24" height="24">
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                    <span class="d-block text-dark">Account Settings</span>
                                </div>
                            </a>
                        </div>
                        <div class="message-body">
                            <a href="{{route('affiliate-marketer.password')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                    <img src="{{ asset('admin_assets/images/icon-inbox.svg') }}" alt=""
                                        width="24" height="24">
                                </span>
                                <div class="w-75 d-inline-block v-middle ps-3">
                                    <h6 class="mb-1 bg-hover-primary fw-semibold"> Change Password </h6>
                                    {{-- <span class="d-block text-dark">Account Settings</span> --}}
                                </div>
                            </a>
                        </div>
                        <div class="d-grid py-4 px-7 pt-8">
                            <a href="{{ route('affiliate-marketer.logout') }}" class="btn btn-outline-primary">Log Out</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

    </nav>
</header>
