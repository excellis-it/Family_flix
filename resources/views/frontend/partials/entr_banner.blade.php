<section class="imdb-sec">
    <div class="imdb-slider">
        @foreach ($entertainments_banners as $banner)
            <div class="imdb-slider-wrap">
                <div class="imdb-slide-box">
                    <div class="imdb-slide-img">
                        <img src="{{ Storage::url($banner->banner_image) }}" alt="" />
                        <div class="imdb-slide-text">
                            <div class="imdb-slide-movie">
                                <img src="{{ Storage::url($banner->banner_logo) }}" alt="" />
                            </div>
                            <div class="imdb-slide-rate d-flex justify-content-end align-items-center">
                                <ul>
                                    <li>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span>
                                                @if ($banner->rating >= $i)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-solid fa-star-o"></i>
                                                @endif
                                            </span>
                                        @endfor
                                    </li>

                                </ul>


                                <div class="imdb-img">
                                    <img src="{{ asset('frontend_assets/images/imdb.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="imdb-img-text">
                                <p>{{ $banner->small_text }}</p>
                            </div>
                            <div class="imdb-content">
                                <p>
                                  {{ $banner->long_description }}
                                </p>
                            </div>
                            <div class="sign-up-btn mt-lg-5 mt-md-2 text-end">
                                <a href="{{ route('pricing') }}">{{ $banner->button_name }}</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
       
    </div>
</section>