


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
<!--    <title>{{env('APP_NAME')}} | Sign In</title>-->
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
<!--    <link id="themeColors" rel="stylesheet" href="{{ asset('user_assets/css/responsive.css')}}">-->
<!--    <link rel="stylesheet" type="text/css"-->
<!--        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">-->
<!--</head>-->



    <!--  Body Wrapper -->
    <section class="login_bg">
        <!--  Main wrapper -->
        <div class="container">
            <!--  Row 1 -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
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
                                        <input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="E-mail Address">
                                        @if ($errors->has('email'))
                                            <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" id="inputChoosePassword" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                    @endif
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="log-btn w-100">Login</button>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p class="text-center">Don't have an account? <a href="{{ route('customer.register') }}" class="sign-btn">Sign Up</a></p>
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





@endsection
