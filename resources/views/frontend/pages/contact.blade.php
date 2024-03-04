@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Contact
@endsection
@push('styles')
@endpush

@section('content')
    <section class="inner_banner_sec"
        style="
  background-image: url({{ Storage::url($contact_cms->banner_img) }});
  background-position: center bottom;
  background-repeat: no-repeat;
  background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h1>{{ $contact_cms->title }}</h1>
                        <div class="links-1">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="">{{ $contact_cms->title }}</a></li>
                            </ul>
                        </div>
                        <div class="inr-text">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-sec">
        <div class="contact-bg">
            <img src="{{ Storage::url($contact_cms->background_img) }}" alt="" />
        </div>
        <div class="container">
            <div class="contact-sec-wrap">
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-5">
                        <div class="heading-white">
                            <h3>{{ $contact_cms->main_title }}</h3>
                            <p>
                                {{ $contact_cms->short_title }}
                            </p>
                            <form action="{{ route('contact-us.submit') }}" method="post" id="contact-form">
                                @csrf
                                <div class="contact-form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group-wrap">
                                                <input type="text" class="form-control"  name="user_name"
                                                    placeholder="Your Name*">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group-wrap">
                                                <input type="email" class="form-control"  name="user_email"
                                                    placeholder="Your Email*">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group-wrap">
                                                <input type="text" class="form-control"  name="user_number"
                                                    placeholder="Phone Number*">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group-wrap">
                                                <textarea class="form-control" name="user_message" rows="3" placeholder="Your Message*"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="sign-up-btn mt-4">
                                                <button type="submit">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="sign-up-btn mt-4">
                            <a href="" tabindex="0">Contact Us</a>
                          </div> -->
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cont-right">
                            <div class="heading-white mb-4">
                                <h3>Get In Touch</h3>
                            </div>
                            <div class="find-us">
                                @include('frontend.partials.contact-details')
                               
                            </div>
                        </div>
                        <div class="follow-sec">
                            <div class="add">
                                <div class="add-text">
                                    <p>Follow Us</p>
                                </div>
                                <div class="folow-icon d-flex">
                                  @foreach($social_icons as $social_icon)
                                    <a href="{{ $social_icon->link }}"><i class="{{ $social_icon->icon }}"></i></a>
                                    
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="map-sec">
        <iframe loading="lazy"
            src="{{ $contact_cms->map_link }}"
            title="Orlando, Florida" aria-label="Orlando, Florida" width="100%" height="450px"></iframe>
    </section>
@endsection

@push('scripts')

<script>
   $(document).ready(function() {
    $('#contact-form').validate({
        rules: {
            user_name: "required",
            user_email: {
                required: true,
                email: true
            },
            user_number: "required", // <- Missing comma here
            user_message: "required" // <- No comma needed here
        },
        messages: {
            user_name: "Name is required",
            user_email: {
                required: "Email is required",
                email: "Please enter a valid email address"
            },
            user_number: {
                required: "Phone is required"
            },
            user_message: "Message is required" // <- No comma needed here
        },
        submitHandler: function(form) {
            // You can perform additional actions or AJAX submission here
            form.submit();
        }
    });
});

</script>
@endpush
