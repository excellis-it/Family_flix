<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="generator" content="" />
    <title>CheckOut</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
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
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    @php
        use App\Helpers\Helper;
    @endphp
    <main>
        <section id="loading">
            <div id="loading-content" style="display:none;">
                <img src="{{ asset('frontend_assets/images/loading.gif') }}">
            </div>
        </section>

        <section class="checkout-sec">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-7">
                        <div class="ck-header-wrap">
                            <div class="logo1 text-center">
                                <a href="{{ route('home') }}"><img src="{{ asset('frontend_assets/images/logo.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="ck-text text-center">
                                <h2>You are almost there</h2>
                                <p>Unlock a world of limitless entertainment with The Family Flix. Enjoy unparalleled
                                    access to a
                                    diverse content library and seamless streaming on your terms.</p>
                            </div>
                            <div class="security-div">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                <div
                                                    class="security-icon d-flex align-items-center justify-content-center">
                                                    <span><i class="fa-solid fa-shield"></i></span>
                                                    <h4>SSL secured checkout</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div
                                                    class="security-icon d-flex align-items-center justify-content-center">
                                                    <span><i class="fa-solid fa-shield"></i></span>
                                                    <h4>24/7 support available</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div
                                                    class="security-icon d-flex align-items-center justify-content-center">
                                                    <span><i class="fa-solid fa-shield"></i></span>
                                                    <h4>Payment option</h4>
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
        </section>
        <section class="checkout-form-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="checkout-form">
                            {{-- <form id="signUpForm" action="{{ route('create-subscription') }}" method="post"> --}}

                            <form action="" method="post" id="signUpForm">
                                @csrf
                                <!-- start step indicators -->
                                <div class="form-header d-flex mb-4">
                                    <span class="stepIndicator">Information</span>
                                    <span class="stepIndicator">Finish</span>
                                </div>
                                <!-- end step indicators -->


                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-left">
                                            <!-- step one -->
                                            <div class="step">
                                                <div class="step-div">
                                                    <h3>Customer information</h3>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="email_address"
                                                            id="email_address" placeholder=""
                                                            value="{{ Auth::user()->email ?? '' }}">
                                                        <label for="floatingInput1">Email Address
                                                            <span>*</span></label>
                                                        <span id="email_error" class="text-danger"></span>
                                                    </div>
                                                    @if (!auth()->check())
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="password"
                                                                id="password" placeholder="" value="">
                                                            <label for="floatingInput1">Password
                                                                <span>*</span></label>
                                                            <span id="password_error" class="text-danger"></span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="step-div">
                                                    <h3>Billing details</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="first_name" id="first_name" placeholder=""
                                                                    value="{{ $customer_details->first_name ?? '' }}">
                                                                <label for="floatingInput2">First Name
                                                                    <span>*</span></label>
                                                                <span id="first_name_error"
                                                                    class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="last_name" id="last_name" placeholder=""
                                                                    value="{{ $customer_details->last_name ?? '' }}">
                                                                <label for="floatingInput3">Last Name
                                                                    <span>*</span></label>
                                                                <span id="last_name_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="country" name="country" placeholder=""
                                                                    value="{{ $customer_details->country ?? '' }}">
                                                                <label for="floatingSelect1">Country
                                                                    <span>*</span></label>
                                                                <span id="country_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="house_name" name="house_name" placeholder=""
                                                                    value="{{ $customer_details->house_no_street_name ?? '' }}">
                                                                <label for="floatingInput4">House number and street
                                                                    name <span>*</span></label>
                                                                <span id="house_name_error"
                                                                    class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="detail_address" name="detail_address"
                                                                    placeholder=""
                                                                    value="{{ $customer_details->apartment ?? '' }}">
                                                                <label for="floatingInput5">Apartment, suite, unit,
                                                                    etc.<span>*</span></label>
                                                                <span id="detail_address_error"
                                                                    class="text-danger"></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="city" name="city" placeholder=""
                                                                    value="{{ $customer_details->town ?? '' }}">
                                                                <label for="floatingInput6">City
                                                                    <span>*</span></label>
                                                                <span id="city_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="state" name="state" placeholder=""
                                                                    value="{{ $customer_details->state ?? '' }}">
                                                                <label for="floatingInput7">State
                                                                    <span>*</span></label>
                                                                <span id="state_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="post_code" name="post_code" placeholder=""
                                                                    value="{{ $customer_details->post_code ?? '' }}">
                                                                <label for="floatingInput8">Post code
                                                                    <span>*</span></label>
                                                                <span id="post_code_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="phone" id="phone" placeholder=""
                                                                    value="{{ $customer_details->phone ?? '' }}">
                                                                <label for="floatingInput9">Phone
                                                                    <span>*</span></label>

                                                                <span id="phone_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-floating mb-3">
                                                                    <select class="form-select" name="payment_type"
                                                                        id="floatingSelect2"
                                                                        aria-label="Floating label select example">
                                                                        @if (Auth::check() && $plan_exists > 0)
                                                                        <option value="Renewal">Renewal</option>
                                                                        @else
                                                                        <option value="New Subscription">New
                                                                            Subscription</option>
                                                                        @endif
                                                                    </select>

                                                                    <label for="floatingSelect2">payment Type
                                                                        <span>*</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    <div class="step-div">
                                                        <h3>Additional information</h3>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="additional_information"
                                                                        name="additional_information" style="height: 100px"></textarea>
                                                                    <label for="floatingTextarea2">Notes about your
                                                                        order, e.g. special notes for
                                                                        delivery.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="step-div">
                                                        <h3>Payment</h3>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-div">
                                                                    <h3>Paypal</h3>
                                                                    <h4>Pay via PayPal.</h4>
                                                                </div>
                                                                <div class="check-1">
                                                                    <div class="form-check d-flex">
                                                                        <input class="form-check-input"
                                                                            type="checkbox" value=""
                                                                            id="flexCheckChecked">
                                                                        <label class="form-check-label"
                                                                            for="flexCheckChecked">
                                                                            I would like to receive exclusive emails
                                                                            with discounts and product information
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="check-text">
                                                                    <p>Your personal data will be used to process
                                                                        your
                                                                        order, support your experience
                                                                        throughout this website, and for other
                                                                        purposes
                                                                        described in our privacy policy</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            {{-- <button class="paypal-btn" type="submit"><img
                                                        src="{{ asset('frontend_assets/images/paypal.png') }}"></button>
                                                <button class="paypal-btn paypal-btn-2 mt-2"><span><i
                                                            class="fa-solid fa-credit-card"></i></span>Debit or Credit
                                                    Card</button> --}}

                                            <div id="paypal-button-container"></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-right">
                                            <div class="step-div">
                                                <h3>Your Order</h3>
                                            </div>
                                            <div class="form-right-table">
                                                <table class="table">
                                                    <div class="table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-name">Plan</th>
                                                                <th class="product-total text-end"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $plan->plan_name }}</td>
                                                                <td class="text-end">x 1 &nbsp;
                                                                    ${{ $plan->plan_offer_price }} / month(30 days)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td class="text-end"> ${{ $plan->plan_offer_price }}
                                                                </td>
                                                            </tr>
                                                            <tr class="coupon-dis">
                                                                <td>Coupon Discount</td>
                                                                <td class="text-end "> $0.00
                                                                </td>
                                                            </tr>
                                                            <tr class="total-order">
                                                                <th>Total</th>
                                                                <th class="text-end">${{ $plan->plan_offer_price }}
                                                                </th>
                                                            </tr>
                                                            <tr class="recurring">
                                                                <th>Recurring amounts</th>
                                                                <div class="text-end">
                                                                    <td class="text-end">
                                                                        ${{ $plan->plan_offer_price }}/
                                                                        month<br><span>(ex. VAT)</span></td>
                                                                </div>
                                                            </tr>
                                                        </tbody>
                                                    </div>
                                                </table>
                                            </div>
                                            <input type="hidden" name="plan_name" id="plan_name"
                                                value="{{ $plan->plan_name }}">
                                            <input type="hidden" name="plan_price" id="plan_price"
                                                value="{{ $plan->plan_offer_price }}">
                                            <input type="hidden" name="amount"
                                                value="{{ $plan->plan_offer_price }}" id="total_amount">
                                            <input type="hidden" id="coupan_code" name="coupan_code">
                                            <input type="hidden" id="coupon_discount" name="coupon_discount">
                                            <input type="hidden" id="coupon_discount_type"
                                                name="coupon_discount_type">
                                            <input type="hidden" name="plan_id" id="plan_id"
                                                value="{{ $plan->id }}">

                                            <div class="cupon-div-main">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-lg-8">
                                                        <div class="cupon-div">
                                                            <div class="">
                                                                <input type="text" class="form-control"
                                                                    id="coupon_code" placeholder="Coupon Code">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <button class="apply-btn" type="button"
                                                            id="nextBtn">Apply</button>
                                                    </div>
                                                    <span id="coupon_error"></span>

                                                </div>
                                            </div>

                                        </div>


                                        {{-- <div class="coupan-code">
                                                <p><span>Code :</span> FAMILY0011 &nbsp;<i
                                                        class="fa-regular fa-copy"></i></p>
                                            </div> --}}

                                        <div id="coupon-container">

                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq_sec">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <div class="faq-head mb-5">
                                <h2>Frequently <span>Asked Questions</span></h2>
                            </div>
                        </div>
                        <div class="faq_project">
                            <div class="accordion" id="accordionExample">
                                <div class="row justify-content-between">
                                    <div class="col-xl-12">
                                        <div class="faq-left">
                                            @foreach ($faq_qstn_ansrs as $index => $faq_qstn_ansr)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $index }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $index }}">
                                                            {{ $faq_qstn_ansr->question }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $index }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading{{ $index }}"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $faq_qstn_ansr->answer }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        {{-- user exists modal --}}
        @auth
        @else
            <div class="modal fade" id="userExistsModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="userExistsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">User Exists</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>User already exists with this email address. Please login to continue.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('customer.login') }}"><button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Ok</button></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- user exists modal --}}

            <footer class="ck-ftr">
                <div class="container">
                    <div class="ck-ftr-wrap">
                        <div class="ck-ftr-top">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-12">
                                    <div class="ck-ftr-menu">
                                        <ul>
                                            <li><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                                            <li><a href="{{ route('term-service') }}">Terms of service</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="ck-ftr-btm">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="ck-ftr-btm-img">
                                    <img src="{{ asset('frontend_assets/images/poweredbyblack.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </footer>
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

        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


        {{-- paypal credit --}}
        {{-- <script
            src="https://www.paypal.com/sdk/js?client-id=AWQWgAsqAtQ6B2GRSRfRpuy07Ny5i-KyBWQQc23bv0zNQsecQUuY0iixsOGCkx2cS4NNpxwmHbyacJNQ">
        </script> --}}
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
            // coupon check and total amount discount
            $(document).ready(function() {
                $('#nextBtn').click(function() {
                    var coupon_code = $('#coupon_code').val();
                    var plan_id = {{ $plan->id }};
                    var plan_price = {{ $plan->plan_offer_price }};
                    var emailId = $('#floatingInput1').val();
                    var phone = $('#floatingInput9').val();

                    if (emailId == '') {
                        alert('Please enter email address');
                        return false;
                    } else if (phone == '') {
                        alert('Please enter phone number');
                        return false;
                    } else {
                        $.ajax({
                            url: "{{ route('coupon-check') }}",
                            type: "POST",
                            data: {
                                coupon_code: coupon_code,
                                plan_price: plan_price,
                                plan_id: plan_id,
                                emailId: emailId,
                                phone: phone,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    var total = response.discount;
                                    var discount = response.coupon_discount;
                                    var discpount_type = response.coupon_discount_type;
                                    $('#total_amount').val(total);
                                    $('#coupan_code').val(coupon_code);
                                    $('#coupon_discount').val(discount);
                                    $('#coupon_discount_type').val(discpount_type);
                                    $('.coupon-dis').html(
                                        '<th>Coupon Discount</th><th class="text-end">-$' +
                                        discount + '</th>');

                                    $('.total-order').html('<th>Total</th><th class="text-end">$' +
                                        total + '</th>');
                                    $('.recurring').html(
                                        '<th>Recurring totals</th><div class="text-end"><td class="text-end">$' +
                                        total + '/ month<br><span>(ex. VAT)</span></td></div>');
                                    $('#coupon_error').text('Coupon Applied').css('color', 'green');
                                } else {
                                    //show message invlid coupon
                                    $('#coupon_error').text('Invalid Coupon Code').css('color',
                                        'red');
                                    $('#total_amount').val(plan_price);
                                    $('#coupan_code').val('');
                                    $('#coupon_discount').val('0.00');
                                    $('#coupon_discount_type').val('');
                                    $('.coupon-dis').html(
                                        '<th>Coupon Discount</th><th class="text-end">-$00.0 </th>'
                                    );

                                    $('.total-order').html('<th>Total</th><th class="text-end">$' +
                                        plan_price + '</th>');
                                    $('.recurring').html(
                                        '<th>Recurring totals</th><div class="text-end"><td class="text-end">$' +
                                        plan_price +
                                        '/ month<br><span>(ex. VAT)</span></td></div>');

                                }
                            }
                        });
                    }

                });
            });
        </script>

        {{-- form validation --}}

        <script src="https://www.paypal.com/sdk/js?client-id={{ Helper::paypalCredential()['client_id'] ?? '' }}"></script>

        <script>
            let formData = {};
            let checkStatus = true;

            paypal.Buttons({
                onClick: async function() {
                    formData = {
                        email: document.getElementById('email_address').value,
                        first_name: document.getElementById('first_name').value,
                        last_name: document.getElementById('last_name').value,
                        country: document.getElementById('country').value,
                        house_name: document.getElementById('house_name').value,
                        detail_address: document.getElementById('detail_address').value,
                        city: document.getElementById('city').value,
                        state: document.getElementById('state').value,
                        post_code: document.getElementById('post_code').value,
                        phone: document.getElementById('phone').value,
                        additional_information: document.getElementById('additional_information').value,
                        plan_name: document.getElementById('plan_name').value,
                        plan_price: document.getElementById('plan_price').value,
                        amount: document.getElementById('total_amount').value,
                        coupon_code: document.getElementById('coupan_code').value,
                        coupon_discount: document.getElementById('coupon_discount').value,
                        coupon_discount_type: document.getElementById('coupon_discount_type').value,
                        plan_id: document.getElementById('plan_id').value
                    };

                    // Include password only if user is not authenticated
                    if (!{{ auth()->check() ? 'true' : 'false' }}) {
                        formData.password = document.getElementById('password').value;
                    }

                    const validationUrl = "{{ route('payments.validate') }}";

                    try {
                        const response = await fetch(validationUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(formData)
                        });

                        const result = await response.json();

                        if (result.success) {
                            $('.text-danger').text('');
                            checkStatus = true;
                        } else {
                            checkStatus = false;
                            $('.text-danger').text('');
                            if (result.errors) {
                                $.each(result.errors, function(field, message) {
                                    if (result.single == true) {
                                        console.error('Validation Error:', message);
                                        toastr.error(message);
                                    } else {
                                        $('#' + field + '_error').text(message);
                                    }
                                });
                            } else {
                                toastr.error(result.error);
                            }
                        }
                    } catch (error) {
                        console.error('Validation Error:', error);
                        toastr.error('An error occurred during validation.');
                        checkStatus = false;
                    }

                    return checkStatus;
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        application_context: {
                            brand_name: 'The Family Flix',
                            user_action: 'PAY_NOW',
                        },
                        purchase_units: [{
                            amount: {
                                value: $('#total_amount').val(),
                            }
                        }],
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        if (details.status === 'COMPLETED') {
                            const captureUrl = "{{ route('paypal-capture-payment') }}";

                            return fetch(captureUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        ...formData,
                                        paymentID: data.paymentID
                                    })
                                })
                                .then(response => response.json())
                                .then(responseData => {
                                    if (responseData.success) {
                                        window.location.href = '{{ route('paypal-success-payment') }}';
                                    } else {
                                        toastr.error(responseData.message);
                                        window.location.href = '{{ route('paypal-pay-failed') }}';
                                    }
                                })
                                .catch(error => {
                                    console.error('Capture Error:', error);
                                    window.location.href = '{{ route('paypal-pay-failed') }}';
                                });
                        } else {
                            window.location.href = '{{ route('paypal-pay-failed') }}';
                        }
                    });
                },

                onError: function(err) {
                    console.error('PayPal Error:', err);
                    toastr.error('An error occurred during the PayPal transaction.');
                }
            }).render('#paypal-button-container');
        </script>



        <script>
            //onchange validation
            $('#floatingInput1').on('change', function() {
                var emailId = $('#floatingInput1').val();

                $.ajax({
                    url: "{{ route('payments.email-check') }}",
                    type: "POST",
                    data: {
                        emailId: emailId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#email_error').text('');
                        } else {
                            $('#userExistsModal').modal('show');
                            return true;
                        }
                    }
                });
            });
        </script>
        @auth
            <script>
                $(document).ready(function() {

                    var payment_type = $('#floatingSelect2').val();
                    var plan_name = $('#plan_name').val();

                    $.ajax({
                        url: "{{ route('payments.payment-type-check') }}",
                        type: "POST",
                        data: {
                            payment_type: payment_type,
                            plan_name: plan_name,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                if (response.same_plan == true) {
                                    return true;
                                }

                            } else {

                                Swal.fire({
                                    title: 'You already have an active subscription',
                                    text: 'Do you want to renew your subscription? or would you prefer to wait until your current subscription expires before starting the new one?',
                                    icon: 'info',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('customer.subscription') }}";
                                        // Code to execute when the user confirms
                                    } else {
                                        // Code to execute when the user cancels
                                    }
                                });


                            }
                        }
                    });
                });
            </script>
        @endauth

    </body>

    </html>
