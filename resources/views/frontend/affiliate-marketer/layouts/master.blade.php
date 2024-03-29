<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <!--  Required Meta Tag -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="handheldfriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="description" content="Mordenize">
    <meta name="author" content="">
    <meta name="keywords" content="Mordenize">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/owl.carousel.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('admin_assets/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    @stack('styles')
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #074465; color:#ffff;">
                    <h5 class="modal-title" id="exampleModalLabel">Affiliate URL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="affiliateLink">Your Affiliate Link:</label>
                        <div class="input-group">
                            <input type="text" class="form-control"  id="affiliateLink" value="{{route('pricing', Crypt::encrypt(Auth::user()->id))}}" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="copyButton">Copy</button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Click the "Copy" button to copy the affiliate link.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Start -->
    <div id="show-sidebar">
        @include('frontend.affiliate-marketer.includes.sidebar')
    </div>

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        @include('frontend.affiliate-marketer.includes.header')
        <!--  Header End -->
        @yield('content')

    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
</div>

<!--  Search Bar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-1">
            <div class="modal-header border-bottom">
                <input type="search" class="form-control fs-3" placeholder="Search here" id="search">
                <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
                    <i class="ti ti-x fs-5 ms-3"></i>
                </span>
            </div>
            <div class="modal-body message-body" data-simplebar="">
                <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                <ul class="list mb-0 py-2">
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Modern</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                            <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Posts</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Detail</span>
                            <span
                                class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Shop</span>
                            <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Modern</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                            <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                            <span class="fs-3 text-muted d-block">/apps/contacts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Posts</span>
                            <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Detail</span>
                            <span
                                class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                        </a>
                    </li>
                    <li class="p-1 mb-1 bg-hover-light-black">
                        <a href="#">
                            <span class="fs-3 text-black fw-normal d-block">Shop</span>
                            <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- @include('frontend.affiliate-marketer.includes.footer') --}}

<!--  Import Js Files -->
<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
<!--  core files -->
<script src="{{ asset('admin_assets/js/app.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/app.init.js') }}"></script>
<script src="{{ asset('admin_assets/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('admin_assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom.js') }}"></script>
<!--  current page js files -->
<script src="{{ asset('admin_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script>
    window.addEventListener('load', () => {
        $('.select23').select2();
    });
</script>
<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>


<!--Sidebar menu-->
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

            element.addEventListener('click', function(e) {

                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;

                if (nextEl) {
                    e.preventDefault();
                    let mycollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        var opened_submenu = parentEl.parentElement.querySelector(
                            '.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }

                    }
                }

            });
        })

    });
</script>

<script>
   $(document).ready(function() {
    // Add click event listener to the copy button
    $('#copyButton').click(function() {
        // Select the text inside the input field
        $('#affiliateLink').select();
        // Copy the selected text to the clipboard
        document.execCommand('copy');
        // Optionally, provide visual feedback to the user
        var $button = $(this); // Store reference to the button
        // show "Copied!" for 1 second
        $button.text('Copied!').addClass('btn-success').prop('disabled', true);
        setTimeout(function() {
            $button.text('Copy').removeClass('btn-success').prop('disabled', false);
        }, 1000);
    });
});

</script>
@stack('scripts')
</body>

</html>
