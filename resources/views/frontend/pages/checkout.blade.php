<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
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
    <!-- Custom styles for this template -->


</head>

<body>
    @php
        use App\Helpers\Helper;
    @endphp
    <main>

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
                            <form id="signUpForm" action="{{ route('process-payments') }}" method="post">
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
                                                            id="floatingInput1" placeholder=""
                                                            value="{{ Auth::user()->email ?? '' }}">
                                                        <label for="floatingInput1">Email Address <span>*</span></label>
                                                        <span id="email_error" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="step-div">
                                                    <h3>Billing details</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="first_name" id="floatingInput2" placeholder=""
                                                                    value="">
                                                                <label for="floatingInput2">First Name
                                                                    <span>*</span></label>
                                                                <span id="fname_error" class="text-danger"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="last_name" id="floatingInput3"
                                                                    placeholder="">
                                                                <label for="floatingInput3">Last Name
                                                                    <span>*</span></label>
                                                                <span id="lname_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingSelect1" name="country"
                                                                    placeholder="">
                                                                <label for="floatingSelect1">Country/Region
                                                                    <span>*</span></label>
                                                                <span id="country_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput4" name="house_name"
                                                                    placeholder="">
                                                                <label for="floatingInput4">House number and street
                                                                    name <span>*</span></label>
                                                                <span id="houseNo_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput5" name="detail_address"
                                                                    placeholder="">
                                                                <label for="floatingInput5">Apartment, suite, unit,
                                                                    etc.
                                                                    (optional) <span>*</span></label>
                                                                <span id="addr_error" class="text-danger"></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput6" name="city"
                                                                    placeholder="">
                                                                <label for="floatingInput6">Town/City
                                                                    <span>*</span></label>
                                                                <span id="city_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput7" name="state"
                                                                    placeholder="">
                                                                <label for="floatingInput7">State/Country
                                                                    <span>*</span></label>
                                                                <span id="state_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput8" name="post_code"
                                                                    placeholder="">
                                                                <label for="floatingInput8">Post code
                                                                    <span>*</span></label>
                                                                <span id="postCode_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="phone" id="floatingInput9" placeholder=""
                                                                    value="{{ Auth::user()->phone ?? '' }}">
                                                                <label for="floatingInput9">Phone
                                                                    <span>*</span></label>

                                                                <span id="phone_error" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" name="payment_type"
                                                                    id="floatingSelect2"
                                                                    aria-label="Floating label select example">

                                                                    <option value="New Subsription">New Subsription
                                                                    </option>
                                                                    <option value="Renewal">Renewal</option>
                                                                </select>
                                                                <label for="floatingSelect2">payment Type
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="step-div">
                                                        <h3>Additional information</h3>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                                        name="additional_information" style="height: 100px"></textarea>
                                                                    <label for="floatingTextarea2">Notes about your
                                                                        order, e.g. special notes for
                                                                        delivery.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="step-div">
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
                                                                    <p>Your personal data will be used to process your
                                                                        order, support your experience
                                                                        throughout this website, and for other purposes
                                                                        described in our privacy policy</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                <h3>Your Oder</h3>
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
                                                                    ${{ $plan->plan_offer_price }} / month</td>
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
                                                                <th>Recurring totals</th>
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
                                            <input type="hidden" id="coupon_discount_type" name="coupon_discount_type">



                                            <div class="cupon-div-main">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-lg-8">
                                                        <div class="cupon-div">
                                                            <div class="">
                                                                <input type="text" class="form-control"
                                                                    id="coupon_code" placeholder="Cupon Code">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <button class="apply-btn" type="button"
                                                            id="nextBtn">Apply</button>
                                                    </div>
                                                    <span id="coupon_error" class="text-danger"></span>
                                                </div>
                                            </div>
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

                                            {{-- <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  What devices can I use to access The Family Flix?
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                 <p> The Family Flix is compatible with all major platforms, including mobile devices, tablets, and smart TVs. Download our app for a seamless viewing experience.</p>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  Is there a free trial available?
                                </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                 <p>Yes, we offer a free trial period for new subscribers. Explore our content and features risk-free before committing to a subscription.</p>
                                </div>
                              </div>
                            </div> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="col-xl-6">
                          <div class="faq-left">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How can I cancel my subscription?
                              </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                              data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                <p>You can easily manage your subscription in the account settings on our website. If you need assistance, our customer support team is available 24/7 to guide you through the process.</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Can I switch plans or upgrade my subscription?
                              </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                              data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                               <p>Absolutely! You can upgrade or switch plans at any time. Visit your account settings to make the changes that suit your entertainment needs.</p>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Are there any hidden fees or contracts?
                              </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                              data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                               <p>No hidden fees or long-term contracts. The Family Flix believes in transparency and providing you with a straightforward, hassle-free entertainment experience.</p>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        {{-- user exists modal --}}

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
                    <div class="ck-ftr-btm">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="ck-ftr-btm-img">
                                    <img src="{{ asset('frontend_assets/images/poweredbyblack.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
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

    {{-- paypal credit --}}
    {{-- <script
        src="https://www.paypal.com/sdk/js?client-id=AWQWgAsqAtQ6B2GRSRfRpuy07Ny5i-KyBWQQc23bv0zNQsecQUuY0iixsOGCkx2cS4NNpxwmHbyacJNQ">
    </script> --}}


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
                                $('#coupon_error').text('');
                            } else {
                                //show message invlid coupon
                                $('#coupon_error').text('Invalid Coupon Code');
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
        checkStatus = true;
        paypal.Buttons({
            onClick: function() {
                var emailId = $('#floatingInput1').val();
                var first_name = $('#floatingInput2').val();
                var last_name = $('#floatingInput3').val();
                var country = $('#floatingSelect1').val();
                var house_name = $('#floatingInput4').val();
                var detail_address = $('#floatingInput5').val();
                var city = $('#floatingInput6').val();
                var state = $('#floatingInput7').val();
                var post_code = $('#floatingInput8').val();
                var phone = $('#floatingInput9').val();
                var payment_type = $('#floatingSelect2').val();

                // Check if any field is empty
                if (emailId == '' || first_name == '' || last_name == '' || country == '' || house_name == '' ||
                    detail_address == '' || city == '' || state == '' || post_code == '' || phone == '' ||
                    payment_type == '') {
                    // Display error messages for empty fields
                    if (emailId == '') {
                        $('#email_error').text('Please enter email address');
                    } else {
                        $('#email_error').text('');
                    }
                    if (first_name == '') {
                        $('#fname_error').text('Please enter first name');
                    } else {
                        $('#fname_error').text('');
                    }
                    if (last_name == '') {
                        $('#lname_error').text('Please enter last name');
                    } else {
                        $('#lname_error').text('');
                    }
                    if (country == '') {
                        $('#country_error').text('Please enter country');
                    } else {
                        $('#country_error').text('');
                    }
                    if (house_name == '') {
                        $('#houseNo_error').text('Please enter house number and street name');
                    } else {
                        $('#houseNo_error').text('');
                    }
                    if (detail_address == '') {
                        $('#addr_error').text('Please enter apartment, suite, unit, etc.');
                    } else {
                        $('#addr_error').text('');
                    }
                    if (city == '') {
                        $('#city_error').text('Please enter town/city');
                    } else {
                        $('#city_error').text('');
                    }
                    if (state == '') {
                        $('#state_error').text('Please enter state/country');
                    } else {
                        $('#state_error').text('');
                    }
                    if (post_code == '') {
                        $('#postCode_error').text('Please enter post code');
                    } else {
                        $('#postCode_error').text('');
                    }
                    if (phone == '') {
                        $('#phone_error').text('Please enter phone');
                    } else {
                        $('#phone_error').text('');
                    }
                    if (payment_type == '') {
                        $('#paymentType_error').text('Please select payment type');
                    } else {
                        $('#paymentType_error').text('');
                    }

                    return false; // Prevent the form submission
                } else {
                    $('#email_error').text('');
                    $('#fname_error').text('');
                    $('#lname_error').text('');
                    $('#country_error').text('');
                    $('#houseNo_error').text('');
                    $('#addr_error').text('');
                    $('#city_error').text('');
                    $('#state_error').text('');
                    $('#postCode_error').text('');
                    $('#phone_error').text('');
                    $('#paymentType_error').text('');

                    // All fields are filled, allow form submission
                    return true;
                }


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
                            checkStatus = false;
                        }
                    }
                });

                if(checkStatus == true) {
                    alert(11111);
                } else {
                    alert(22222);
                }
            },

            createOrder: function(data, actions) {

                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    application_context: {
                        brand_name: 'Laravel Book Store Demo Paypal App',
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

                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    if (details.status == 'COMPLETED') {
                        var route = "{{ route('paypal-capture-payment') }}";
                        return fetch(route, {
                                method: 'post',
                                headers: {
                                    'content-type': 'application/json',
                                    "Accept": "application/json, text-plain, */*",
                                    "X-Requested-With": "XMLHttpRequest",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    paymentID: data.paymentID,
                                    emailId: $('#floatingInput1').val(),
                                    first_name: $('#floatingInput2').val(),
                                    last_name: $('#floatingInput3').val(),
                                    country: $('#floatingSelect1').val(),
                                    house_name: $('#floatingInput4').val(),
                                    detail_address: $('#floatingInput5').val(),
                                    city: $('#floatingInput6').val(),
                                    state: $('#floatingInput7').val(),
                                    post_code: $('#floatingInput8').val(),
                                    phone: $('#floatingInput9').val(),

                                    payment_type: $('#floatingSelect2').val(),
                                    plan_name: $('#plan_name').val(),
                                    plan_price: $('#plan_price').val(),
                                    amount: $('#total_amount').val(),
                                    coupan_code: $('#coupan_code').val(),
                                    coupon_discount: $('#coupon_discount').val(),
                                    coupon_discount_type: $('#coupon_discount_type').val(),
                                    additional_information: $('#floatingTextarea2').val()
                                })
                            })
                            .then(status)
                            .then(function(response) {
                                console.log(response);
                                // redirect to the completed page if paid
                                window.location.href = '{{ route('paypal-success-payment') }}'
                            })
                            .catch(function(error) {
                                console.log(error)
                                // redirect to failed page if internal error occurs
                                window.location.href = '{{ route('paypal-pay-failed') }}'
                            });
                    } else {
                        window.location.href = '{{ route('paypal-pay-failed') }}';
                    }
                });

            },

            // onCancel: function(data) {
            //     window.location.href = '{{ route('paypal-pay-failed') }}';
            // }

            // onShippingChange: function(data, actions) {
            //     // Handle shipping changes here
            // }

        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
        function status(res) {
            if (!res.ok) {
                throw new Error(res.statusText);
            }
            return res;
        }
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
</body>

</html>
