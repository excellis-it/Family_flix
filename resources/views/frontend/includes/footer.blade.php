
@php
$contact_details = App\Models\ContactDetails::get(); 
$footer_cms =  App\Models\FooterCms::first(); 
@endphp


<footer class="ftr-sec">
    <div class="ftr-bg">
      <img src="{{ Storage::url($footer_cms->footer_background)}}" alt="" />
    </div>
    <div class="ftr-top">
      <div class="container">
        <div class="ftr-top-wrap">
          <div class="row justify-content-between">
            <div class="col-xl-3 col-md-6 col-12">
              <div class="footer-logo">
                <a href=""><img src="{{ Storage::url($footer_cms->footer_logo)}}" alt="" /></a>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 col-12">
              <div class="find-us">
                <h4>Quick Links</h4>
                <div class="ftr-link ftr-link-1">
                  <ul>
                    <li class="">
                      <a href="{{ route('home') }}"> Home </a>
                    </li>
                    <li>
                      <a href="{{ route('shows') }}">Shows</a>
                    </li>
                    <li>
                      <a href="{{ route('movies') }}">Movies</a>
                    </li>
                    <li>
                      <a href="{{ route('kids') }}">Kids</a>
                    </li>
                    <li>
                      <a href="{{ route('pricing') }}">Pricing</a>
                    </li>
                    <li>
                      <a href="{{ route('about') }}">About Us</a>
                    </li>
                    <li>
                      <a href="{{ route('contact-us') }}"> contact</a>
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
                    <li><a href="{{ route('faqs') }}">FAQ</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact</a></li>
                    <li><a href="{{ route('term-service') }}">Terms of service</a></li>
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
              <div class="find-us">
                <h4>Contact Us</h4>
                @foreach($contact_details as $contact_detail)
                <div class="add d-flex">
                  <div class="add-icon">
                    <span><i class="{{ $contact_detail->icon }}"></i></span>
                  </div>
                  <div class="add-text">
                    <h4>{{ $contact_detail->title }}</h4>
                    <a href="">{{ $contact_detail->details }}</a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-xl-12">
                <div class="ftr-link ftr-btm-img text-center">
                  <img
                    src="{{ Storage::url($footer_cms->footer_image)}}"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>