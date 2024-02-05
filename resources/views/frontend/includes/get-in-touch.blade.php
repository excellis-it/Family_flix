<!-- contact section - start -->
<div class="contact-section" id="contact">
    <div class="contact-section-wrapper">
        <div class="container">
            <div class="row gx-5">
                <!-- form - start -->
                <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                    <div class="contact-form position-relative">
                        <div class="contact-form-wrapper bg-light">
                            <h3 class="ls-1 t-center m-horz-auto heading-width-res-full heading-width-92">Want to learn more? Get in touch.</h3>
                            <form>
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control"
                                        id="nameField"
                                        placeholder="Full name"
                                    >
                                    <label for="nameField">Full name</label>
                                </div>
                                <div class="form-floating">
                                    <input 
                                        type="email"
                                        class="form-control"
                                        id="emailField"
                                        placeholder="Email address"
                                    >
                                    <label for="emailField">Email address</label>
                                </div>
                                <div class="form-floating">
                                    <input 
                                        type="text"
                                        class="form-control"
                                        id="messageField"
                                        placeholder="Message"
                                    >
                                    <label for="messageField">Message</label>
                                </div>
                                <!-- <div class="form-row">
                                    <div class="checkbox">
                                        <input type="checkbox" name="patient" id="patientCheck">
                                        <label for="patientCheck">I'm a Patient</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="practitioner" id="practitionerCheck">
                                        <label for="practitionerCheck">I'm a Practitioner</label>
                                    </div>
                                </div> -->
                                <div class="form-submit mt-3">
                                    <button type="button" class="button button-full-width button-red">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="box-small box-top-left bg-red wow pulse" data-wow-delay="0.4s" data-wow-iteration="infinite"></div>
                    </div>
                </div>
                <!-- form - end -->
                <!-- cta - start -->
                <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                    <div class="cta position-relative mt-lg-0 mt-5">
                        <div class="cta-wrapper bg-light">
                            <div class="heading">
                                <h3 class="ls-1 t-center m-horz-auto heading-width-76">Join today and get 20% off your plan.</h3>
                            </div>
                            <div class="image" style="background-image: url('{{ asset('frontend_assets/assets/images/cta-image.jpg')}}');">
                                <!-- <img src="" alt="cta"> -->
                            </div>
                            <a href="#" class="button button-blue">
                                <span>Learn more</span>
                            </a>
                        </div>
                        <div class="box-small box-top-left bg-blue  wow pulse" data-wow-delay="0.8s" data-wow-iteration="infinite"></div>
                    </div>
                </div>
                <!-- cta - end -->
            </div>
        </div>
    </div>
</div>
<!-- contact section - end -->