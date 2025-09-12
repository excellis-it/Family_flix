<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="" />
    <meta name="generator" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title', 'The Family Flix')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend_assets/images/logo.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css" rel="stylesheet" />

    <link href="{{ asset('frontend_assets/css/menu.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend_assets/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend_assets/css/circle.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->

    {{-- toastr cdn --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CC9CJZ88JX"></script>

    @if (Request::is('faq*'))
        <script type=""application/ld+json"">
{
  ""@context"": ""https://schema.org"",
  ""@type"": ""FAQPage"",
  ""mainEntity"": [{
    ""@type"": ""Question"",
    ""name"": ""What is The Family Flix?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""The Family Flix is a extra ordinary multimedia platform that gathers many different media information which users store in their cloud and allows then to create a vast library of movies, TV series, and exclusive content. By doing so users will be able to view various contents from other multiple platforms including Netflix, Amazon Prime, Hulu, Disney Plus, and more through our application from their cloud they uploaded all under one roof. Our service is designed to provide an affordable and convenient alternative to managing multiple subscriptions.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""How does The Family Flix offer content from different streaming platforms?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""Our multimedia platform gathers different media information, which users can store in their cloud and access it by connecting The Family Flix to different devices.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""What subscription plans are available?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""The Family Flix offers several subscription plans tailored to meet different needs and preferences. Our plans vary based on the number of screens that can be used simultaneously, video quality, and access to exclusive content. For detailed information on our plans, please visit our Subscription Plans page.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""Can I watch content on The Family Flix without an internet connection?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""Yes, The Family Flix offers a download feature for mobile and tablet devices, allowing you to download your favorite shows and movies to watch offline. This feature is perfect for keeping entertained while on the move without internet access.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""How can I watch The Family Flix on my TV?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""The Family Flix is compatible with various devices including most smart TVs, streaming media players, gaming consoles, and more. You can also cast The Family Flix from your mobile device or computer to your TV using Chromecast or AirPlay.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""Are there any parental controls available?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""Yes, The Family Flix provides comprehensive parental controls allowing you to set viewing restrictions and create a safe viewing environment for children. You can customize profiles with age-appropriate content filters.""
    }
  },{
    ""@type"": ""Question"",
    ""name"": ""Can I share my account with friends and family?"",
    ""acceptedAnswer"": {
      ""@type"": ""Answer"",
      ""text"": ""Our subscription plans include options to create multiple user profiles and allow simultaneous streaming on multiple devices. You can share your account with friends and family according to the terms of your selected plan.""
    }
  }]
}
</script>
    @else
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-CC9CJZ88JX');
        </script>

        <script type=""application/ld+json"">
{
  ""@context"": ""https://schema.org/"",
  ""@type"": ""WebSite"",
  ""name"": ""The Family Flix"",
  ""url"": ""https://thefamilyflix.com/"",
  ""potentialAction"": {
    ""@type"": ""SearchAction"",
    ""target"": ""https://thefamilyflix.com/pricing{search_term_string}Unlimited subscription plans for family streaming"",
    ""query-input"": ""required name=search_term_string""
  }
}
</script>
    @endif


</head>

<body>
    <main>

        @php
            $subscribe_cms = App\Models\SubscribeCms::first();
        @endphp

        @include('frontend.includes.header')
        @yield('content')
        <style>
            @media (max-width:1280px) {

                .vdo-img {
                    height: 250px;
                    margin-top: -9%;
                }

            }

            @media (max-width:1600px) {

                .imdb-sec {
                    margin-top: -6.2%;
                }


            }
        </style>
        <section class="subscribe-sec">
            <div class="container">
                <div class="subscribe-sec-wrap">
                    <div class="row justify-content-center">
                        <div class="col-xl-11">
                            <div class="subscribe-head">
                                <h2>{{ $subscribe_cms->subscribe_title }}</h2>
                            </div>
                            <form action="{{ route('subscribe.submit') }}" method="post" id="subscription-form">
                                @csrf
                                <div class="subscribe-form">
                                    <div class="row ">
                                        <div class="col-xl-12">
                                            <div class="subscribe-form-wrap">
                                                <input type="text" class="form-control" name="user_email"
                                                    placeholder="{{ $subscribe_cms->subscription_placeholder }}">
                                                @if ($errors->has('name'))
                                                    <div class="error" style="color:red;">
                                                        {{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sign-up-btn subscribe-btn mt-4">
                                        <button type="submit">{{ $subscribe_cms->button_name }}</button>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="subscribe-line"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @include('frontend.includes.footer')

        <div class="scroll-top">
            <a id="scroll-top-btn"></a>
        </div>
    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('frontend_assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox-plus-jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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
        $(document).ready(function() {
            $('#subscription-form').validate({
                rules: {
                    user_email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    user_email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to check if user is authenticated
            function checkAuthentication() {
                @auth
                // If user is authenticated, open popup
                Swal.fire({

                    text: "You're currently logged in another account. Please log out of this account.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, log out!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, log out
                        window.location.href = "{{ route('any-user.logout') }}";
                    }
                })
            @else
                // If user is not authenticated, proceed to customer login
                var loginRoute = $('.cust-login').attr('href');
                window.location.href = loginRoute; // Redirect to customer login route
            @endauth
        }

        // Call the function to check authentication when the customer login link is clicked
        $('.cust-login').click(function(event) {
            event.preventDefault(); // Prevent the default link behavior
            checkAuthentication();
        });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to check if user is authenticated
            function checkAuthenticationAffi() {
                @auth
                Swal.fire({

                    text: "You're currently logged in another account. Please log out of this account.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, log out!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, log out
                        window.location.href = "{{ route('any-user.logout') }}";
                    }
                })
            @else
                // If user is not authenticated, proceed to customer login
                var loginRoute = $('.affi-login').attr('href');
                window.location.href = loginRoute; // Redirect to customer login route
            @endauth
        }

        // Call the function to check authentication when the customer login link is clicked
        $('.affi-login').click(function(event) {
            event.preventDefault(); // Prevent the default link behavior
            checkAuthenticationAffi();
        });
        });
    </script>


    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/653826c8a84dd54dc484cbc2/1hdhlf0qv';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script> --}}
    <!--End of Tawk.to Script-->


    <script type="text/javascript">
        function loadAcDiv(t) {
            let e;
            (e = t.createElement("div")).id = "embed-ab", e.async = !0, e.setAttribute("data-ab-id", "ZLqZX5je"), e
                .setAttribute("data-btn-bg", "#239789"), e.setAttribute("data-btn-img",
                    "https://myagencycoach.agency/storage/uploads/5457/img_1723028547_iEk.png"), e.setAttribute(
                    'data-avtr-img', "https://myagencycoach.agency/storage/uploads/5457/img_1723028389_68d.png"), e
                .setAttribute("data-ab-url", "https://myagencycoach.agency"), e.setAttribute("data-bub-ani", "anim-ok"), e
                .setAttribute("data-wid-pos", "fcpw-right"), t.body.appendChild(e)
        }

        function initialize(t) {
            let e;
            (e = t.createElement("script")).id = "script-ab", e.async = !0, (e.type = "text/javascript"), e.src =
                "https://myagencycoach.agency/assets/chat/embed.js", e.onload = loadAcDiv(t), t.body.appendChild(e)
        }
        window.addEventListener ? window.addEventListener("load", initialize(document), !1) : window.attachEvent("load",
            initialize(document), !1);
    </script>



    @stack('scripts')

</body>

</html>
