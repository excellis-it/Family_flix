<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- title tag -->
    <title>Design Journey</title>

    <!-- stylesheets -->
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body>
    <main>

        @php
        $contact_us = App\Models\ContactUsCms::first();
        $home_cms = App\Models\HomeCms::first();
        use App\Helpers\Subscribing;
        @endphp



        @include('frontend.includes.header')
        @yield('content')
        <!-- contact section - start -->
        <div class="contact-section " id="contact"
            style="{{ Request::is('blogs*') || Request::is('help-center*') || Request::is('career*') ? 'display:none' : '' }}">
            <div class="contact-section-wrapper">
                <div class="container">
                    <div class="row gx-5">
                        <!-- form - start -->
                        <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                            <div class="contact-form position-relative">
                                <div class="contact-form-wrapper bg-light">
                                    <h3 class="ls-1 t-center m-horz-auto heading-width-res-full heading-width-92">Want
                                        to learn more? Get in touch.</h3>
                                    <form action="{{ route('contact-us.submit') }}" method="post" id="contact-form">
                                        @csrf
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nameField" name="full_name"
                                                placeholder="Full name">
                                            <label for="nameField">Full name</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="emailField"
                                                name="email_address" placeholder="Email address">
                                            <label for="emailField">Email address</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="messageField" name="message"
                                                placeholder="Message">
                                            <label for="messageField">Message</label>
                                        </div>
                                        <!-- <div class="form-row">
                                    <div class="checkbox">
                                        <input type="checkbox" name="patient" id="patientCheck">
                                        <label for="patientCheck">I'm a Patient</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="practitioner" id="practitionerCheck">
                                        <label for="practitionerCheck">I'm a Practitioner</label>
                                    </div>
                                </div> -->
                                        <div class="form-floating">
                                            <div class="form-submit mt-3">
                                                <button type="submit" class="button button-full-width button-red">
                                                    <span>Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-small box-top-left bg-red wow pulse" data-wow-delay="0.4s"
                                    data-wow-iteration="infinite"></div>
                            </div>
                        </div>
                        <!-- form - end -->
                        <!-- cta - start -->
                        <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                            <div class="cta position-relative mt-lg-0 mt-5">
                                <div class="cta-wrapper bg-light">
                                    <div class="heading">
                                        <h3 class="ls-1 t-center m-horz-auto heading-width-76">{{ $contact_us->text }}
                                        </h3>
                                    </div>
                                    <div class="image"
                                        style="background-image: url('{{ Storage::url($contact_us->image) }}');">
                                        <!-- <img src="" alt="cta"> -->
                                    </div>
                                    <a href="{{ route('pricing') }}" class="button button-blue">
                                        <span>Learn more</span>
                                    </a>
                                </div>
                                <div class="box-small box-top-left bg-blue  wow pulse" data-wow-delay="0.8s"
                                    data-wow-iteration="infinite"></div>
                            </div>
                        </div>
                        <!-- cta - end -->
                    </div>
                </div>
            </div>
        </div>

        <!--  subscription modal  -->

        <div class="modal modal-create fade" id="subscriptionModal" tabindex="-1"
            aria-labelledby="subscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="btn-close subscription-close" aria-label="Close" ></button>
                    <!--<div class="modal-header">-->
                    <!--    <h2 class="modal-title fs-5" id="subscriptionModalLabel">newsletter subscriptions</h2>-->
                    <!--    <button type="button" class="btn-close subscription-close" aria-label="Close" ></button>-->
                    <!--</div>-->
                    <form action="{{ route('subscription.submit') }}" method="post" id="subscription_form">
                        @csrf
                        <div class="modal-body p-0">
                            <div class="modal-form-div">
                                <div class="login_sec">
                                    <div class="login_sec_wrap">
                                        <div class="container-fluid">
                                            <div class="row justify-content-end">
                                                  <div class="col-xl-5 col-lg-12 col-12 p-0">
                                                    <div class="login-left-image">
                                                      <img src="{{ Storage::url(Subscribing::SubcriptionCmsContent()->image) }}" alt="orions-logo">  
                                                    </div>  
                                                   </div>          
                                                <div class="col-xl-7 col-lg-12 col-12 p-0">
                                                    <div class="login_sec_left">
                                                        <div class="login_sec_left_bg"></div>
                                                        <div class="width_545">
                                                            <div class="main_hh">
                                                                 <div class="login_sec_right_text">
                                                                    <div class="login-logo-sub">
                                                                       <a href=""><img src="{{ asset('frontend_assets/assets/images/logo.png')}}" alt="orions-logo"></a>
                                                                   </div>
                                                                   <h3>Newsletter Subscription</h3>
                                                                   <div class="login-logo-head">
                                                                         <p>{{ Subscribing::SubcriptionCmsContent()->title }}
                                                                        
                                                                         </p>
                                                                    </div>
                                                                </div>
                                                                <div class="login_form">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1"
                                                                                class="form-label">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                name="user_name" id="user_name"
                                                                                aria-describedby="emailHelp" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="txtPassword">Email</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" name="user_email"  id="user_email"
                                                                                    class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-check form-check-inline mb-3" style="font-size:14px;">
                                                                            
                                                                          <input class="form-check-input" name="check_box" type="checkbox" id="check_box" >
                                                                          <label class="form-check-label" for="check_box">{!! Subscribing::SubcriptionCmsContent()->disclaimers !!}
</label>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-lg btn-primary btn-block btn-login">
                                                                            Subscribe
                                                                        </button>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="create-form">-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="user_name">Name</label>-->
                            <!--        <input type="text" class="form-control" name="user_name"  id="user_name">-->
                            <!--        <span id="nameError" class="text-danger"></span>-->
                            <!--    </div>-->
                            <!--    <div class="form-group">-->
                            <!--        <label for="user_email">Email</label>-->
                            <!--        <input type="text" class="form-control" name="user_email"  id="user_email">-->
                            <!--        <span id="nameError" class="text-danger"></span>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                        <!--<div class="modal-footer text-left">
                            <button type="submit" class="btn" id="createSubscription">Subcribe</button>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
        <!--  subscription modal end-->
        
        
        
        
        
        
        
        
        <!--  subscription modal  -->
        <!--<div class="modal modal-create fade" id="disclamer" tabindex="-1"-->
        <!--    aria-labelledby="disclamerModalLabel" aria-hidden="true">-->
        <!--    <div class="modal-dialog">-->
        <!--        <div class="modal-content">-->
        <!--            <div class="modal-header">-->
        <!--                <h2 class="modal-title fs-5" id="disclamerModalLabel">newsletter subscriptions</h2>-->
        <!--                <button type="button" class="btn-close subscription-close" aria-label="Close" data-bs-dismiss="modal"></button>-->
        <!--            </div>-->
        <!--            <form action="" method="post" id="">-->
        <!--                <div class="modal-body">-->
        <!--                    <div class="modal-form-div">-->
        <!--                        <div class="popup_sec">-->
        <!--                            <div class="popup_sec_wrap">-->
        <!--                                <div class="row justify-content-end">-->
        <!--                                    <div class="col-xl-12 col-lg-12 col-12 p-0">-->
        <!--                                        <div class="popup_sec_left">-->
        <!--                                            <div class="width_545">-->
        <!--                                                <div class="main_hh">-->
        <!--                                                    <div class="login_sec_right_text">-->
        <!--                                                        <div class="login-logo-sub">-->
        <!--                                                           <a href=""><img src="{{ asset('frontend_assets/assets/images/logo.png')}}" alt="orions-logo"></a>-->
        <!--                                                       </div>-->
        <!--                                                       <div class="login-logo-head">-->
        <!--                                                             <p>{{ Subscribing::SubcriptionCmsContent()->title }}-->
                                                                    
        <!--                                                             </p>-->
        <!--                                                        </div>-->
        <!--                                                    </div>-->
        <!--                                                    <div class="login_form">-->
        <!--                                                        <div class="form-group">-->
        <!--                                                            <label for="exampleInputEmail1"-->
        <!--                                                                class="form-label">Name</label>-->
        <!--                                                            <input type="text" class="form-control"-->
        <!--                                                                name="user_name" id="user_name"-->
        <!--                                                                aria-describedby="emailHelp" />-->
        <!--                                                        </div>-->
        <!--                                                        <div class="form-group">-->
        <!--                                                            <label for="txtPassword">Email</label>-->
        <!--                                                            <div class="position-relative">-->
        <!--                                                                <input type="text" name="user_email"  id="user_email"-->
        <!--                                                                    class="form-control" />-->
        <!--                                                            </div>-->
        <!--                                                        </div>-->
        <!--                                                        <button type="submit"-->
        <!--                                                            class="btn btn-lg btn-primary btn-block btn-login">-->
        <!--                                                            Subscribe-->
        <!--                                                        </button>-->
        <!--                                                    </div>-->
        <!--                                                    <div class="login_sec_right_text mt-3">-->
        <!--                                                       <div class="login-logo-head">-->
        <!--                                                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
        <!--                                          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.-->
        <!--                                          It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.-->
        <!--                                          It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>-->
        <!--                                                        </div>-->
        <!--                                                    </div>-->
        <!--                                                </div>-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--  subscription modal end-->
        
        
        <!--  subscription modal  -->
        <!--<div class="modal modal-create fade" id="disclamer1" tabindex="-1"-->
        <!--    aria-labelledby="disclamerModalLabel" aria-hidden="true">-->
        <!--    <div class="modal-dialog">-->
        <!--        <div class="modal-content">-->
        <!--            <div class="modal-header">-->
        <!--                <h2 class="modal-title fs-5" id="disclamerModalLabel">newsletter subscriptions</h2>-->
        <!--                <button type="button" class="btn-close subscription-close" aria-label="Close" ></button>-->
        <!--            </div>-->
        <!--            <form action="" method="post" id="">-->
        <!--                <div class="modal-body">-->
        <!--                    <div class="modal-form-div">-->
        <!--                        <div class="popup_sec">-->
        <!--                            <div class="popup_sec_wrap">-->
        <!--                                <div class="row justify-content-end">-->
        <!--                                    <div class="col-xl-12 col-lg-12 col-12 p-0">-->
        <!--                                        <div class="popup_sec_left">-->
        <!--                                            <div class="width_545">-->
        <!--                                                <div class="main_hh">-->
        <!--                                                     <div class="login_sec_right_text">-->
        <!--                                                        <div class="login-logo-sub">-->
        <!--                                                           <a href=""><img src="{{ asset('frontend_assets/assets/images/logo.png')}}" alt="orions-logo"></a>-->
        <!--                                                       </div>-->
        <!--                                                       <div class="login-logo-head">-->
        <!--                                                             <p>{{ Subscribing::SubcriptionCmsContent()->title }}-->
                                                                    
        <!--                                                             </p>-->
        <!--                                                        </div>-->
        <!--                                                    </div>-->
        <!--                                                    <div class="login-left-text">-->
        <!--                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
        <!--                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.-->
        <!--                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.-->
        <!--                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>-->
        <!--                                            <div class="form-check form-check-inline mb-3" style="font-size:16px;">-->
        <!--                                              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">-->
        <!--                                              <label class="form-check-label" for="inlineCheckbox1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</label>-->
        <!--                                            </div>-->
        <!--                                          <button type="submit" class="btn btn-lg btn-primary btn-login" data-bs-dismiss="modal">Confirm</button>-->
        <!--                                        </div>  -->
        <!--                                                </div>-->
        <!--                                            </div>-->
        <!--                                        </div>-->
        <!--                                    </div>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--  subscription modal end-->
        
        
        
        
        
        


        <!-- contact section - end -->
        @include('frontend.includes.footer')
    </main>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>

        var words1 = @json($home_cms->main_title2);
        var words = words1.split(",");
        var colors1 = @json($home_cms->main_title2_color);
        var colors = colors1.split(",");
    
        var counter = 0;
        var currentIndex = getRandomInt(0, words.length - 1);
    
        var text = document.getElementById("text2");
        var stepInterval = setInterval(() => { step(); }, 200);
        var delInterval = null;
        var delTimeout = null;
    
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    
        function delIntervalCallback() {
            delInterval = setInterval(() => { del(); }, 100);
            clearTimeout(delTimeout);
        }
    
        function del() {
            if (counter == 0) {
                let newIndex = getRandomInt(0, words.length - 1);
                while (newIndex == currentIndex) {
                    newIndex = getRandomInt(0, words.length - 1);
                }
                currentIndex = newIndex;
                clearInterval(delInterval);
                stepInterval = setInterval(() => { step(); }, 200);
            } else {
                text.textContent = text.textContent.slice(0, -1);
                counter--;
            }
        }
    
        function step() {
            if (counter >= words[currentIndex].length) {
                clearInterval(stepInterval);
                delTimeout = setTimeout(() => { delIntervalCallback(); }, 2000);
            } else {
                text.textContent += words[currentIndex][counter];
                text.style.color = colors[currentIndex]; // Set dynamic color
                counter++;
            }
        }
    
    </script>
    <script>
        @if (Session:: has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
        @endif

        @if (Session:: has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
        @endif

        @if (Session:: has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
        @endif

        @if (Session:: has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        //if condition for popup variaable is true or not
        
        @if(Subscribing::NewsletterSubscription() == false)
            @if(session('close-subscription-modal') == false)
            $(document).ready(function () {
                $('#subscriptionModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#subscriptionModal').modal('show');
            });
            @elseif(session('close-subscription-modal') == true)   
                $('#subscriptionModal').modal('hide');
            @else
            $(document).ready(function () {
                $('#subscriptionModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#subscriptionModal').modal('show');
            });
            @endif
        @endif
    </script>

    <script>
        $('.subscription-close').click(function () {
            //ajax call
            $.ajax({
                url: "{{ route('subscription.modal-close') }}",
                type: "GET",
                success: function (response) {
                    console.log(response.status);
                    if (response.status == true) {
                        $('#subscriptionModal').modal('hide');
                    }else{
                        console.log('error');
                    }    
                }
            });
            // $('#subscriptionModal').modal('hide');
        });
        </script>

    <script>
        $(document).ready(function () {
            $('#subscription_form').validate({
                rules: {
                    user_name: "required",
                    check_box: "required",
                    user_email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    user_name: "Name is required",
                    check_box: "Please checked the box",
                    user_email: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
    $(document).on("click","a[id='news-letter']", function (e) {
        e.preventDefault();

        $('#subscriptionModal').modal({
                    backdrop: 'static',
                    keyboard: false
        });
        $('#subscriptionModal').modal('show');
    
        // $('#subscriptionModal').modal('show');
    });
    </script>


    <script>
        $(document).ready(function () {
            $('#contact-form').validate({
                rules: {
                    full_name: "required",
                    email_address: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                    }
                },
                messages: {
                    full_name: "Full name is required",
                    email_address: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    message: {
                        required: "Message is required",

                    }
                },
                submitHandler: function (form) {
                    // You can perform additional actions or AJAX submission here
                    form.submit();
                }
            });
        });
    </script>
    <script>
        // $(document).ready(function () {
        //         $('#disclamer').modal({
        //             backdrop: 'static',
        //             keyboard: false
        //         });
        //         $('#disclamer').modal('show');
        //     });
    </script>
    <script>
        // $(document).ready(function () {
        //         $('#disclamer1').modal({
        //             backdrop: 'static',
        //             keyboard: false
        //         });
        //         $('#disclamer1').modal('show');
        //     });
    </script>
    
    @stack('scripts')
</body>

</html>