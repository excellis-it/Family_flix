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
                                <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="">
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
                                    <!-- <span class="stepIndicator">Account Setup</span> -->
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
                                                            id="floatingInput" placeholder="">
                                                        <label for="floatingInput">Email Address *</label>
                                                    </div>
                                                </div>
                                                <div class="step-div">
                                                    <h3>Billing details</h3>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="first_name" id="floatingInput" placeholder="">
                                                                <label for="floatingInput">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="last_name" name="last_name" placeholder="">
                                                                <label for="floatingInput">Last Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="country" placeholder="">
                                                                <label for="floatingSelect">Country/Region
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="house_name"
                                                                    placeholder="">
                                                                <label for="floatingInput">House number and street
                                                                    name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="detail_address"
                                                                    placeholder="">
                                                                <label for="floatingInput">Apartment, suite, unit, etc.
                                                                    (optional)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="city" placeholder="">
                                                                <label for="floatingInput">Town/City</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="state" placeholder="">
                                                                <label for="floatingSelect">Country/Region
                                                                    <span>*</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="floatingInput" name="post_code"
                                                                    placeholder="">
                                                                <label for="floatingInput">Post code</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="phone" id="floatingInput" placeholder="">
                                                                <label for="floatingInput">Phone</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" name="payment_type"
                                                                    id="floatingSelect"
                                                                    aria-label="Floating label select example">
                                                                    <option value="New Subsription">New Subsription
                                                                    </option>
                                                                    <option value="Renewal">Renewal</option>
                                                                </select>
                                                                <label for="floatingSelect">payment Type
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
                                                                <th class="product-name">{{ $plan->plan_name }}</th>
                                                                <th class="product-total text-end">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Professional</td>
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
                                            <input type="hidden" name="amount"
                                                value="{{ $plan->plan_offer_price }}" id="total_amount">
                                                <input type="hidden" id="coupan_code" name="coupan_code">
                                               <input type="hidden" id="coupon_discount" name="coupon_discount">
                                               
                                            
                                                <input type="hidden" name="affiliated_id" value="">



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
                                                        <button class="apply-btn" type="button" id="nextBtn">Apply</button>
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

        <footer class="ftr-sec">
            <div class="ftr-bg">
                <img src="{{ asset('frontend_assets/images/ftr-bg.png') }}" alt="" />
            </div>
            <div class="ftr-top">
                <div class="container">
                    <div class="ftr-top-wrap">
                        <div class="row justify-content-between">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="footer-logo">
                                    <a href=""><img src="{{ asset('frontend_assets/images/ftr.png') }}"
                                            alt="" /></a>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="find-us">
                                    <h4>Quick Links</h4>
                                    <div class="ftr-link ftr-link-1">
                                        <ul>
                                            <li class="">
                                                <a href="index.html"> Home </a>
                                            </li>
                                            <li>
                                                <a href="show.html">Shows</a>
                                            </li>
                                            <li>
                                                <a href="movies.html">Movies</a>
                                            </li>
                                            <li>
                                                <a href="kids.html">Kids</a>
                                            </li>
                                            <li>
                                                <a href="pricing.html">Pricing</a>
                                            </li>
                                            <li>
                                                <a href="about.html">About Us</a>
                                            </li>
                                            <li>
                                                <a href="contact.html"> contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="find-us">
                                    <h4>Customer Support</h4>
                                    <div class="ftr-link ftr-link-1">
                                        <ul>
                                            <li><a href="">FAQ</a></li>
                                            <li><a href="">Contact</a></li>
                                            <li><a href="#">Terms of service</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="find-us">
                                    <h4>Contact Us</h4>
                                    <div class="add d-flex">
                                        <div class="add-icon">
                                            <span><i class="fa-solid fa-phone"></i></span>
                                        </div>
                                        <div class="add-text">
                                            <h4>Call Us</h4>
                                            <a href="">+18453297101</a>
                                        </div>
                                    </div>
                                    <div class="add d-flex">
                                        <div class="add-icon">
                                            <span><i class="fa-solid fa-envelope"></i></span>
                                        </div>
                                        <div class="add-text">
                                            <h4>Email Us</h4>
                                            <a href="">support@thefamilyflix.com</a>
                                        </div>
                                    </div>
                                    <div class="add d-flex">
                                        <div class="add-icon">
                                            <span><i class="fa-solid fa-location-dot"></i></span>
                                        </div>
                                        <div class="add-text">
                                            <h4>Location</h4>
                                            <p>Orlando Florida</p>
                                        </div>
                                    </div>
                                    <div class="add d-flex">
                                        <div class="add-icon">
                                            <span><i class="fa-regular fa-clock"></i></span>
                                        </div>
                                        <div class="add-text">
                                            <h4>Office Hours (Closed Saturday)</h4>
                                            <p>9am-11pm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="ftr-link ftr-btm-img text-center">
                                        <img src="{{ asset('frontend_assets/images/poweredbywhite-1024x124.png') }}"
                                            alt="" />
                                    </div>
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


    <script>
        // coupon check and total amount discount
        $(document).ready(function() {
            $('#nextBtn').click(function() {
                var coupon_code = $('#coupon_code').val();
                var plan_price = {{ $plan->plan_offer_price }};
                
                $.ajax({
                        url: "{{ route('coupon-check') }}",
                        type: "POST",
                        data: {
                            coupon_code: coupon_code,
                            plan_price: plan_price,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                var total = response.discount;
                                var discount = response.coupon_discount;
                                $('#total_amount').val(total);
                                $('#coupan_code').val(coupon_code);
                                $('#coupon_discount').val(discount);
                                $('.coupon-dis').html('<th>Coupon Discount</th><th class="text-end">-$' + discount + '</th>');
                               
                                $('.total-order').html('<th>Total</th><th class="text-end">$' + total + '</th>');
                                $('.recurring').html('<th>Recurring totals</th><div class="text-end"><td class="text-end">$' + total + '/ month<br><span>(ex. VAT)</span></td></div>');
                                $('#coupon_error').text('');
                              } else {
                              //show message invlid coupon
                              $('#coupon_error').text('Invalid Coupon Code');
                               
                            }
                          }
                    });
            });
        });
    </script>
</body>

</html>
