<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>{{env('APP_NAME')}} | Forget Password</title>
    <!--  Required Meta Tag -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="handheldfriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="description" content="Mordenize">
    <meta name="author" content="">
    <meta name="keywords" content="Mordenize">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  Favicon -->
    <link rel="shortcut icon" type="{{ asset('admin_assets/image/png') }}" href="favicon.ico">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/owl.carousel.min.css') }}">

    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('admin_assets/css/style.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <!--  Body Wrapper -->
    <div class="login_bg">

        <!--  Main wrapper -->
        <div class="container">
            <!--  Row 1 -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card w-100">
                        <div class="card-body">
                            <a href="{{route('home')}}" class="text-nowrap d-block text-center mx-auto logo-img mb-4">
                                <img src="{{ asset('admin_assets/images/logo.png') }}" class="dark-logo" alt="">
                            </a>
                            <form action="{{ route('affiliate-marketer.forget.password') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="E-mail Address">
                                        @if ($errors->has('email'))
                                            <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                   
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="print_btn w-100">Send</button>
                                    </div>
                                    
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



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
</body>

</html>
