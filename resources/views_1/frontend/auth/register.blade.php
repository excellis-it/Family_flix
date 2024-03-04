<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title tag -->
    <title>Design Journey</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/glightbox.min.css"> -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.min.css">
    <!-- <link rel="stylesheet" href="assets/css/overlay-scrollbars.min.css"> -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>

<body>

    @php
    use App\Helpers\General;
    @endphp

    <!-- preloader - start -->
    <!--<div class="preloader">-->
    <!--    <div class='sk-folding-cube'>-->
    <!--        <div class='sk-cube sk-cube-1 bg-red'></div>-->
    <!--        <div class='sk-cube sk-cube-2 bg-green'></div>-->
    <!--        <div class='sk-cube sk-cube-4 bg-yellow'></div>-->
    <!--        <div class='sk-cube sk-cube-3 bg-purple'></div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- preloader - end -->
    <!-- Login-Page -->
    <section class="login-page">
            <div class="login-page-wrap">
                <div class="row align-items-center justify-content-between m-0">
                    <div class="col-lg-6 order-lg-1 order-2 p-0">
                        <div class="login-left">
                            <div class="login-logo logo-fixing">
                                <a href="{{ route('home') }}"> <img src="{{Storage::url(General::GeneralCmsContent()->website_logo)}}" alt=""></a>
                            </div>
                            <div class="login-text text-center">
                                <h3>{{ General::GeneralCmsContent()->registration_title }}</h3>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('register.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    First name</label>
                                                <input type="text" class="form-control"  name="first_name" value="{{ old('first_name') }}" id="exampleFormControlInput1"
                                                    placeholder="Enter Your First name" >
                                                    @if($errors->has('first_name'))
                                                    <div class="error" style="color:red;">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="txtPassword">Last name</label>
                                                <div class="ps-div position-relative">
                                                    <input type="text" id="txtPassword" value="{{ old('last_name') }}" name="last_name" class="form-control"
                                                        name="txtPassword" placeholder="Enter your Last name">
                                                        @if($errors->has('last_name'))
                                                        <div class="error" style="color:red;">{{ $errors->first('last_name') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="txtPassword">Email</label>
                                                <div class="ps-div position-relative">
                                                    <input type="text" id="txtPassword" value="{{ old('email') }}" name="email" class="form-control"
                                                        placeholder="Enter your Email">
                                                        @if($errors->has('email'))
                                                        <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="txtPassword">Create password</label>
                                                <div class="ps-div position-relative">
                                                    <input type="password" id="txtPassword" name="password" class="form-control"
                                                      placeholder="Create your password">
                                                      @if($errors->has('password'))
                                                      <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                                      @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="txtPassword">Confirm password</label>
                                                <div class="ps-div position-relative">
                                                    <input type="password" id="txtPassword"  class="form-control"
                                                        name="confirm_password" placeholder="Confirm your password">
                                                        @if($errors->has('confirm_password'))
                                                        <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="reg-btn-div">
                                               
                                                <button class="reg-btn" type="submit">Register</button>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <div class="join-div">
                                                <p>
                                                    Joined us before? <a href="{{ route('login') }}"> LOGIN NOW</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1 p-0">
                        <div class="login-img">
                            <img src="{{Storage::url(General::GeneralCmsContent()->registration_image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('frontend_assets/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- <script src="assets/js/glightbox.min.js"></script> -->
    <!-- <script src="assets/js/overlay-scrollbars.min.js"></script> -->
    <script src="{{ asset('frontend_assets/assets/js/swiper-bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.12/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="{{ asset('frontend_assets/assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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