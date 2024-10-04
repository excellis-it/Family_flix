<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title tag -->
    <title>Family Flix</title>

    <!-- favicon -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest"> -->

    <!-- stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
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
                            <h3>{{ General::GeneralCmsContent()->login_title }}</h3>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('login.check') }}"method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1" class="form-label">
                                                Email</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Enter Your email address" name="email" value="{{ old('email') }}">
                                                @if($errors->has('email'))
                                                  <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="txtPassword">Password</label>
                                            <div class="ps-div position-relative">
                                                <input type="password" id="txtPassword" class="form-control"
                                                    name="password" placeholder="Enter your password">
                                                    @if($errors->has('password'))
                                                    <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }} col-md-12 mb-3">
                                        <label for="captcha">Captcha</label>
                                        <div class="captcha">
                                            <span>{!! captcha_img() !!}</span>
                                            <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                                        </div>
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                        @if ($errors->has('captcha'))
                                            <span class="help-block">
                                                <div class="error" style="color:red;">{{ $errors->first('captcha') }}</div>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="reg-btn-div">
                                            <!-- <input class="reg-btn" type="submit" value="LOGIN"> -->
                                            <button class="reg-btn" type="submit">LOGIN</button>
                                        </div>
                                        <div class="forgot-ps text-right d-flex justify-content-between align-items-center">
                                            {{-- <div class="remember">
                                                <div class="form-group">
                                                    <input type="checkbox" id="1" name="1" value="1">
                                                    <label for="vehicle1">Remember me</label>
                                                </div>
                                            </div> --}}
                                            <div class="forgot-pass">
                                                <a href="{{ route('forget.password.show') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="join-div">
                                            <p>
                                                Don't have an account? <a href="{{ route('register') }}">Sign Up Now</a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="social_bnr">
                                        <ul>
                                            <li><a class="google_color" href="{{ route('social.login', ['provider' => 'google']) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326667 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M326667 170370c0-13704-1112-23704-3518-34074H166667v61851h91851c-1851 15371-11851 38519-34074 54074l-311 2071 49476 38329 3428 342c31481-29074 49630-71852 49630-122593m0 0z" fill="#4285f4"/><path d="M166667 333333c44999 0 82776-14815 110370-40370l-52593-40742c-14074 9815-32963 16667-57777 16667-44074 0-81481-29073-94816-69258l-1954 166-51447 39815-673 1870c27407 54444 83704 91852 148890 91852z" fill="#34a853"/><path d="M71851 199630c-3518-10370-5555-21482-5555-32963 0-11482 2036-22593 5370-32963l-93-2209-52091-40455-1704 811C6482 114444 1 139814 1 166666s6482 52221 17777 74814l54074-41851m0 0z" fill="#fbbc04"/><path d="M166667 64444c31296 0 52406 13519 64444 24816l47037-45926C249260 16482 211666 1 166667 1 101481 1 45185 37408 17777 91852l53889 41853c13520-40185 50927-69260 95001-69260m0 0z" fill="#ea4335"/></svg></a></li>
                                            <li><a class="facebook_color" href="{{ route('social.login', ['provider' => 'facebook']) }}"><svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 509 509"><g fill-rule="nonzero"><path fill="#0866FF" d="M509 254.5C509 113.94 395.06 0 254.5 0S0 113.94 0 254.5C0 373.86 82.17 474 193.02 501.51V332.27h-52.48V254.5h52.48v-33.51c0-86.63 39.2-126.78 124.24-126.78 16.13 0 43.95 3.17 55.33 6.33v70.5c-6.01-.63-16.44-.95-29.4-.95-41.73 0-57.86 15.81-57.86 56.91v27.5h83.13l-14.28 77.77h-68.85v174.87C411.35 491.92 509 384.62 509 254.5z"/><path fill="#fff" d="M354.18 332.27l14.28-77.77h-83.13V227c0-41.1 16.13-56.91 57.86-56.91 12.96 0 23.39.32 29.4.95v-70.5c-11.38-3.16-39.2-6.33-55.33-6.33-85.04 0-124.24 40.16-124.24 126.78v33.51h-52.48v77.77h52.48v169.24c19.69 4.88 40.28 7.49 61.48 7.49 10.44 0 20.72-.64 30.83-1.86V332.27h68.85z"/></g></svg></a></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1 p-0">
                    <div class="login-img">
                        <img src="{{ Storage::url(General::GeneralCmsContent()->login_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- scripts -->
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

        
<script type="text/javascript">
    $(".btn-refresh").click(function(){
        $.ajax({
            type:'GET',
            url:'/refresh-captcha',
            success:function(data){
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>

</html>