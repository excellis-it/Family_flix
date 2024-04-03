@extends('customer.layouts.master')
@section('title')
    Profile
@endsection

@push('styles')
@endpush

@section('content')
    <section class="inner_banner_sec"
        style="
background-image: url({{ asset('frontend_assets/images/movie-bg.png') }});
background-position: center;
background-repeat: no-repeat;
background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h1>User Panel</h1>
                        <!-- <div class="links-1">
        <ul>
          <li><a href="">Home</a></li>
          <li><a href="">Movies</a></li>
        </ul>
      </div> -->
                        <!-- <div class="inr-text">
        <p>
          Dive into a world of cinematic wonders with our extensive
          collection of movies. The Family Flix Movie Section is your
          gateway to a diverse range of films, spanning genres,
          languages, and cultures. Whether you’re a fan of gripping
          dramas, thrilling action, heartwarming comedies, or
          captivating documentaries, we have something for every movie
          enthusiast.
        </p>
      </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="user-panel">
        <div class="container">
            <div class="user-panel-wrap">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="user-list">
                            <ul>
                                {{-- <li class="active-1"><a href="">Dashboard</a></li> --}}
                                <li class="{{ Request::is('customer/subscription*') ? 'active-1' : '' }}"><a href="{{ route('customer.subscription') }}">Subscribtions</a></li>
                                <li class="{{ Request::is('customer/profile*') ? 'active-1' : '' }}"><a href="{{ route('customer.profile') }}">Account details</a></li>
                                <li><a href="{{ route('customer.logout') }}">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{ route('customer.profile.update') }}" method="post" enctype="multipart/form-data" id="customer-profile">
                           @csrf
                            <div class="user-form user-list">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Full Name<span class="red">*</span>
                                            </label>
                                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Email <span class="red">*</span>
                                            </label>
                                            <input type="text"  name="email" value="{{ Auth::user()->email }}" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Phone 
                                            </label>
                                            <input type="text" name="phone"  value="{{ Auth::user()->phone }}" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Password <span class="red">*</span>
                                            </label>
                                            <input type="text" name="password" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Confirm Password <span class="red">*</span>
                                            </label>
                                            <input type="text"  name="password_confirmation" class="form-control" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group-wrap">
                                            <label for="" class="form-label">Profile Picture
                                            </label>
                                            <input type="file" class="form-control" name="image" id="" placeholder="">
                                        </div>
                                    </div>
                                    
                                
                                    <div class="col-xl-12 text-center">
                                        <div class="sign-up-btn mt-4">
                                            <button type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @push('scripts')
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah')
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>

            $(document).ready(function() {
                
                $('#customer-profile').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        
                        
                    },
                    messages: {
                        name: {
                            required: "Please enter your name",
                        },
                        email: {
                            required: "Please enter your email",
                            email: "Please enter a valid email"
                        },
                       
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });


        </script>
    @endpush
