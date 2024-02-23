<div class="pricing-div">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row justify-content-center">
                @foreach($plan_list as $plan)
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-div-box">
                        <h4>{{ $plan->plan_name }}</h4>
                        <p>
                            {{ $plan->plan_details }}
                        </p>
                        <div class="pricing-rate d-flex justify-content-center mb-4">
                            <h4>${{ $plan->plan_actual_price }}</h4>
                            <h3>${{ $plan->plan_offer_price }}</h3>
                        </div>
                        <div class="sub-btn">
                            <a href="{{ route('create-payments',['id' => encrypt($plan->id)] ) }}
                                ">{{ $plan->button_text }}</a>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                @foreach($plan->Specification as $specification)
                                <li>
                                    <span><i class="fa-solid fa-check"></i></span>{{ $specification->specification_name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
