

@extends('customer.layouts.master')
@section('meta_title')
@endsection

@section('title', 'About Us - Family Flix')


@push('styles')

<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content') 

  
    <!--  Body Wrapper -->
    <section class="login_bg sign-up-bg">
        <!--  Main wrapper -->
        <div class="container">
            <!--  Row 1 -->
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-xl-8">
                  <div class="login-left">
                     <div class="login-head">
                       <h2>Sign Up</h2>
                     </div> 
                       <div class="login-frm">
                                <form action="{{ route('customer.register.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group
                                            col-md-12 mb-3">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="inputEmailAddress" placeholder="Full Name" value="{{ old('full_name') }}">
                                            @if ($errors->has('full_name'))
                                                <div class="error" style="color:red;">{{ $errors->first('full_name') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group
                                            col-md-12 mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone" id="inputEmailAddress" placeholder="Phone Number" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                                <div class="error" style="color:red;">{{ $errors->first('phone') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="E-mail Address" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <div class="error" style="color:red;">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group
                                            col-md-12 mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="inputChoosePassword" placeholder="Password">
                                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                            @if ($errors->has('password'))
                                                <div class="error" style="color:red;">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="inputChoosePassword" placeholder="Password">
                                            <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                        @if ($errors->has('confirm_password'))
                                            <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                        @endif
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
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" class="print_btn log-btn w-100">Sign Up</button>
                                        </div>
        
                                        <div class="col-md-12 mb-3">
                                            <p class="text-center">Already have an account? <a href="{{ route('customer.login') }}">Login</a></p>
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




@endsection
