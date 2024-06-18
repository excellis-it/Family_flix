@extends('customer.layouts.master')
@section('meta_title')
@endsection

@section('title', 'About Us - Family Flix')


@push('styles')
@endpush

@section('content')


    <!--<!DOCTYPE html>-->
    <!--<html lang="en">-->

    <!--<head>-->
    <!--  Title -->
    <!--    <title>{{ env('APP_NAME') }} | Sign In</title>-->
    <!--  Required Meta Tag -->

    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!--    <meta name="handheldfriendly" content="true">-->
    <!--    <meta name="MobileOptimized" content="width">-->
    <!--    <meta name="description" content="Mordenize">-->
    <!--    <meta name="author" content="">-->
    <!--    <meta name="keywords" content="Mordenize">-->
    <!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--  Favicon -->


    <!-- Core Css -->
    <!--    <link id="themeColors" rel="stylesheet" href="{{ asset('user_assets/css/bootstrap.min.css') }}">-->
    <!--    <link id="themeColors" rel="stylesheet" href="{{ asset('user_assets/css/style.css') }}">-->
    <!--    <link id="themeColors" rel="stylesheet" href="{{ asset('user_assets/css/responsive.css') }}">-->
    <!--    <link rel="stylesheet" type="text/css"-->
    <!--        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">-->
    <!--</head>-->



    <!--  Body Wrapper -->
    <section class="login_bg">
        <!--  Main wrapper -->
        <div class="container">
            <!--  Row 1 -->
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-xl-8">
                    <div class="login-left">
                        <div class="login-head">
                            <h2>LOGIN</h2>
                        </div>
                        <div class="login-frm">
                            <form action="{{ route('customer.login.check') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" id="inputEmailAddress"
                                            placeholder="E-mail Address">
                                        @if ($errors->has('email'))
                                            <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" 
                                            placeholder="Password">
                                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                        @if ($errors->has('password'))
                                            <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="forgot-pass">
                                        <a href="{{ route('customer.forget-password.show') }}">Forgot Password?</a>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="log-btn w-100">Login</button>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p class="text-center">Don't have an account? <a
                                                href="{{ route('customer.register') }}" class="sign-btn">Sign Up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Import Js Files -->

    <script src="{{ asset('user_assets/js/custom.js') }}"></script>
    <script src="{{ asset('user_assets/js/jquery.min.js') }}"></script>
    <!--  current page js files -->

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

    
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>


@endsection
