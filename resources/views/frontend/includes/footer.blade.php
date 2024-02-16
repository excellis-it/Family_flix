<footer class="ftr-sec">
    <div class="ftr-bg">
      <img src="{{ asset('frontend_assets/images/ftr-bg.png')}}" alt="" />
    </div>
    <div class="ftr-top">
      <div class="container">
        <div class="ftr-top-wrap">
          <div class="row justify-content-between">
            <div class="col-xl-3 col-md-6 col-12">
              <div class="footer-logo">
                <a href=""><img src="{{ asset('frontend_assets/images/ftr.png')}}" alt="" /></a>
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
                    <li><a href="#">FAQ</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact</a></li>
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
                  <img
                    src="{{ asset('frontend_assets/images/poweredbywhite-1024x124.png')}}"
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