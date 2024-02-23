<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Family Flix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="thank_content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="thank_box">
                        <span><i class="fa fa-check main-content__checkmark" id="checkmark"></i></span>
                        <h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
                        <p class="main-content__body" data-lead-id="main-content-body">
                            Thanks a bunch for filling that out. It means a lot to us, just like you do! We really
                            appreciate you giving
                            us a moment of your time today. Thanks for being you.
                        </p>
                        <a href="{{ route('home') }}"><i class="fa-solid fa-home"></i> Go To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

@php
    
    Session::forget('order_id')
@endphp
