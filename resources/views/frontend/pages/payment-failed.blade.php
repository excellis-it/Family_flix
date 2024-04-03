
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>The family Flix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend_assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  

    <link href="{{ asset('frontend_assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('frontend_assets/css/responsive.css')}}" rel="stylesheet" />
   
    <!-- Custom styles for this template -->
</head>

<body>
    <section class="thankyou-sec">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="check-icon">
                            <span><i class="fa-solid fa-check"></i></span>
                        </div>
                      <div class="thank-text">
                        <h1>Payment Failed</h1>
                        <p>Something went wrong!</p>
                        <a href="{{ route('home') }}"><i class="fa-solid fa-home"></i> Go To Home</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>