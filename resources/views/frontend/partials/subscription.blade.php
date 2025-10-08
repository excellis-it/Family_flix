<section class="experience-sec" style="">
    <div class="experience-bg">
        <img src="{{ Storage::url($subscriptions->section1_background_img) }}" alt="{{$subscriptions->section1_background_img_alt_tag ?? ''}}" />
    </div>
    <div class="experience-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="experience-head">
                                <div class="heading-white">
                                    <h3>
                                        {{ $subscriptions->section1_title }}
                                    </h3>
                                    <p>
                                        {{ $subscriptions->section1_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="sign-up-btn mt-5 text-end">
                                <a href="" tabindex="0">{{ $subscriptions->section1_button_name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
