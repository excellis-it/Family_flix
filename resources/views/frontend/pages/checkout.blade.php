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
                                                            id="floatingInput1" placeholder="">
                                                        <label for="floatingInput1">Email Address <span>*</span></label>
                                                    </div>
                                                </div>
                                                <div class="step-div">
                                                    <h3>Billing details</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="first_name" id="floatingInput2"
                                                                    placeholder="">
                                                                <label for="floatingInput2">First Name
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="last_name" id="floatingInput3"
                                                                    placeholder="">
                                                                <label for="floatingInput3">Last Name
                                                                    <span>*</span></label>
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
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput7" name="state"
                                                                    placeholder="">
                                                                <label for="floatingInput7">State/Country
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput8" name="post_code"
                                                                    placeholder="">
                                                                <label for="floatingInput8">Post code
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="phone" id="floatingInput9"
                                                                    placeholder="">
                                                                <label for="floatingInput9">Phone
                                                                    <span>*</span></label>
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

                                            <button class="paypal-btn" type="submit"><img
                                                    src="{{ asset('frontend_assets/images/paypal.png') }}"></button>


                                            <!-- start previous / next buttons -->
                                            <!-- <div class="form-footer d-flex">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                          </div> -->
                                            <!-- end previous / next buttons -->
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
                                            <input type="hidden" name="plan_name" value="{{ $plan->plan_name }}">
                                            <input type="hidden" name="plan_price"
                                                value="{{ $plan->plan_offer_price }}">
                                            <input type="hidden" name="amount" value="" id="total_amount">
                                            <input type="hidden" id="coupan_code" name="coupan_code">
                                            <input type="hidden" id="coupon_discount" name="coupon_discount">



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


    <script>
        // coupon check and total amount discount
        $(document).ready(function() {
            $('#nextBtn').click(function() {
                var coupon_code = $('#coupon_code').val();
                var plan_id = {{ $plan->id }};
                var plan_price = {{ $plan->plan_offer_price }};

                $.ajax({
                    url: "{{ route('coupon-check') }}",
                    type: "POST",
                    data: {
                        coupon_code: coupon_code,
                        plan_price: plan_price,
                        plan_id: plan_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            var total = response.discount;
                            var discount = response.coupon_discount;
                            $('#total_amount').val(total);
                            $('#coupan_code').val(coupon_code);
                            $('#coupon_discount').val(discount);
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
                            $('.coupon-dis').html(
                                '<th>Coupon Discount</th><th class="text-end">-$00.0 </th>');

                            $('.total-order').html('<th>Total</th><th class="text-end">$' +
                                plan_price + '</th>');
                            $('.recurring').html(
                                '<th>Recurring totals</th><div class="text-end"><td class="text-end">$' +
                                plan_price + '/ month<br><span>(ex. VAT)</span></td></div>');

                        }
                    }
                });
            });
        });
    </script>

    {{-- form validation --}}
    <script>
        $(document).ready(function() {

            $('#signUpForm').validate({
                rules: {
                    email_address: {
                        required: true,
                        email: true
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    house_name: {
                        required: true
                    },
                    detail_address: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    post_code: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    payment_type: {
                        required: true
                    }
                },
                messages: {
                    email_address: {
                        required: "Email is required",
                        email: "Please enter a valid email address"
                    },
                    first_name: {
                        required: "First Name is required"
                    },
                    last_name: {
                        required: "Last Name is required"
                    },
                    country: {
                        required: "Country is required"
                    },
                    house_name: {
                        required: "House Name is required"
                    },
                    detail_address: {
                        required: "Detail Address is required"
                    },
                    city: {
                        required: "City is required"
                    },
                    state: {
                        required: "State is required"
                    },
                    post_code: {
                        required: "Post Code is required"
                    },
                    phone: {
                        required: "Phone is required"
                    },
                    payment_type: {
                        required: "Payment Type is required"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
