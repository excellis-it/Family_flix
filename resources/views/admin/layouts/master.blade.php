<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('admin_assets/assets/bootstrap-5.3/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://unpkg.com/phosphor-icons"></script>
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/app.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/morris.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

</head>


<body class="light light-sidebar theme-white">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!--header-->
            @include('admin.includes.header')

            <!--end header-->
            <!--sidebar-wrapper-->
            @include('admin.includes.sidebar')
            <!--end sidebar-wrapper-->

            <!--page-wrapper-->
            @yield('content')

            <!--end page-wrapper-->

            <!--footer -->
            @include('admin.includes.footer')

            <!-- end footer -->
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('admin_assets/assets/bootstrap-5.3/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/raphael-min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/morris.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/Chart.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/custom.js') }}" async=""></script>
<script src="{{ asset('admin_assets/assets/js/app.min.js') }}"></script>
<script src="{{ asset('admin_assets/assets/js/scripts.js') }}" async=""></script>
<script src="{{ asset('admin_assets/assets/js/jquery-ui.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

{{-- toastr message cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
{{-- sweet alert cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    var colorDanger = "#F4B11A";
    Morris.Donut({
        element: 'donut-example',
        resize: false,
        colors: [
            '#E34804 ',
            '#E34804 ',
            '#F1EFFB',
            '#F1EFFB'
        ],
        //labelColor:"#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [{
                label: "Total Booking",
                value: 200,
                color: colorDanger
            },
            {
                label: "Total Booking",
                value: 120
            },
            {
                label: "Total Booking",
                value: 80
            }
        ]
    });


    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Flight',
                data: [200, 250, 100, 150, 180, 90, 70],
                backgroundColor: "#97C7FF"
            }, {
                label: 'Hotel',
                data: [300, 200, 250, 100, 200, 40, 60],
                backgroundColor: "#1BAC18"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    // Change here
                    barPercentage: 0.8,
                    gridLines: {
                        drawOnChartArea: false,
                        color: "black",
                        zeroLineColor: "black"
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Agency',
                data: [200, 250, 100, 150, 180, 90, 70],
                backgroundColor: "#97C7FF"
            }, {
                label: 'Corporate',
                data: [300, 200, 250, 100, 200, 40, 60],
                backgroundColor: "1BAC18"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }

                }],
                xAxes: [{
                    // Change here
                    barPercentage: 0.8,
                    gridLines: {
                        drawOnChartArea: false,
                        color: "black",
                        zeroLineColor: "black"
                    }
                }]

            }
        }
    });
</script>
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


@stack('scripts')

</html>
