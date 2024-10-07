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
                                                                    <span id="fname_error" class="text-danger"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="last_name" id="last_name" placeholder=""
                                                                        value="{{ $customer_details->last_name ?? '' }}">
                                                                    <label for="floatingInput3">Last Name
                                                                        <span>*</span></label>
                                                                    <span id="lname_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="country"
                                                                        name="country" placeholder=""
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
                                                                    <span id="houseNo_error" class="text-danger"></span>
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
                                                                    <span id="addr_error" class="text-danger"></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="city"
                                                                        name="city" placeholder=""
                                                                        value="{{ $customer_details->town ?? '' }}">
                                                                    <label for="floatingInput6">City
                                                                        <span>*</span></label>
                                                                    <span id="city_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" id="state"
                                                                        name="state" placeholder=""
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
                                                                    <span id="postCode_error"
                                                                        class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control" name="phone"
                                                                        id="phone" placeholder=""
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
                                                                        @if(Auth::check() && $plan_exists > 0)
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
                                                                        <textarea class="form-control"
                                                                            placeholder="Leave a comment here"
                                                                            id="additional_information"
                                                                            name="additional_information"
                                                                            style="height: 100px"></textarea>
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

                                                {{-- <div id="paypal-button-container"></div> --}}
                                                <div class="step-div">
                                                    <h3> Pay Through <i class="fa-brands fa-cc-stripe fa-2xl"></i></h3>
                                                    <div id="card-element" class="card-detail-structure"></div>
                                                    <span id="card_detail_error" class="text-danger"></span>
                                                    <button id="submit-button">Subscribe</button>
                                                </div>

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
                                                <input type="hidden" name="amount" value="{{ $plan->plan_offer_price }}"
                                                    id="total_amount">
                                                <input type="hidden" id="coupan_code" name="coupan_code">
                                                <input type="hidden" id="coupon_discount" name="coupon_discount">
                                                <input type="hidden" id="coupon_discount_type"
                                                    name="coupon_discount_type">
                                                <input type="hidden" name="plan_id" id="plan_id"
                                                    value="{{ $plan->id }}">

                                                {{-- <div class="cupon-div-main">
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
                                                        <span id="coupon_error"></span>

                                                    </div>
                                                </div> --}}
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
                                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                                        aria-expanded="true" aria-controls="collapse{{ $index }}">
                                                        {{ $faq_qstn_ansr->question }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $index }}" class="accordion-collapse collapse"
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
        <div class="modal fade" id="userExistsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="userExistsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Exists</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <div class="ck-ftr-btm">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="ck-ftr-btm-img">
                                    <img src="{{ asset('frontend_assets/images/poweredbyblack.png') }}" alt="">
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

    <script src="https://js.stripe.com/v3/"></script>
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

    <script>
        $(document).ready(function() {
            // $stripe_detail strpe credential
        @php
            $stripeKey = optional(Helper::stripeCredential())->stripe_key;
        @endphp

        var stripeKey = {!! json_encode($stripeKey) !!};
        if (stripeKey) {
            var stripe = Stripe(stripeKey);
        } else {
            console.log('Stripe key not found');
        }
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('signUpForm');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            let formData = {
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

            //rule validation for email, first name, last name, country, house name, detail address, city, state, post code, phone
            function validateField(formData, errorElement, errorMessage) {
                if (formData == '') {
                    $(errorElement).text(errorMessage);
                    return false;
                } else {
                    $(errorElement).text('');
                    return true;
                }
            }
            const isEmailValid = validateField(formData.email, '#email_error', 'Please enter email address');
            const isFirstNameValid = validateField(formData.first_name, '#fname_error', 'Please enter first name');
            const isLastNameValid = validateField(formData.last_name, '#lname_error', 'Please enter last name');
            const isCountryValid = validateField(formData.country, '#country_error', 'Please enter country');
            const isHouseNameValid = validateField(formData.house_name, '#houseNo_error', 'Please enter house number and street name');
            const isDetailAddressValid = validateField(formData.detail_address, '#addr_error', 'Please enter apartment, suite, unit, etc.');
            const isCityValid = validateField(formData.city, '#city_error', 'Please enter town/city');
            const isStateValid = validateField(formData.state, '#state_error', 'Please enter state/country');
            const isPostCodeValid = validateField(formData.post_code, '#postCode_error', 'Please enter post code');
            const isPhoneValid = validateField(formData.phone, '#phone_error', 'Please enter phone');

            // card detail validation
            if (!cardElement._complete) {
                $('#card_detail_error').text('Please enter card details');
                return false;
            }


            if (!isEmailValid || !isFirstNameValid || !isLastNameValid || !isCountryValid || !isHouseNameValid || !isDetailAddressValid || !isCityValid || !isStateValid || !isPostCodeValid || !isPhoneValid) {
                return false;
            }
            
            // Show the loading spinner
            $('#loading-content').show();
            $('#loading').addClass('loading');
            $('#loading-content').addClass('loading-content');

            // Create the Payment Method
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.log(error);
            } else {
                formData.payment_method_id = paymentMethod.id;
                // card details
                formData.card_brand = paymentMethod.card.brand;
                formData.card_last4 = paymentMethod.card.last4;
                formData.card_exp_month = paymentMethod.card.exp_month;
                formData.card_exp_year = paymentMethod.card.exp_year;

                const subscribeUrl = "{{ route('create-subscription') }}";
                fetch(subscribeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    $('#loading-content').hide();
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');

                    if (data.success) {
                        //swal alert
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        
                        window.location.href = "{{ route('success-subscription') }}";
                    } else {
                         window.location.href = "{{ route('failed-subscription') }}";
                        console.log('Subscription failed', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });

    </script>

    <script>
        //onchange validation
        $('#email_address').on('change', function() {
            var emailId = $('#email_address').val();

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
                                $('#coupon_error').text('Invalid Coupon Code').css('color', 'red');
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

    {{-- paypal credit --}}
    {{-- <script
        src="https://www.paypal.com/sdk/js?client-id=AWQWgAsqAtQ6B2GRSRfRpuy07Ny5i-KyBWQQc23bv0zNQsecQUuY0iixsOGCkx2cS4NNpxwmHbyacJNQ">
    </script> --}}

    <script src="https://www.paypal.com/sdk/js?client-id={{ Helper::paypalCredential()['client_id'] ?? '' }}"></script>

    {{-- <script>
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
                        alert(response.status);
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
                                    plan_id: $('#plan_id').val(),
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
                                // window.location.href = '{{ route('paypal-pay-failed') }}'
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
    </script> --}}

  
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
                        if(response.same_plan == true)
                        {
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