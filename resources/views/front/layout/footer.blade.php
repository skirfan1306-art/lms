   <!-- footer area -->
    <footer class="footer-area light">
      <div class="footer-shape">
        <img src="/assets/front/img/shape/02.png" alt="" />
      </div>
      <div class="footer-widget">
        <div class="container">
          <div class="footer-widget-wrap pt-100 pb-50">
            <div class="row g-4">
              <div class="col-lg-5">
                <div class="footer-widget-box about-us">
                  <a href="#" class="footer-logo">
                    <img src="{{ asset('assets/logo/' . $gs->logo ) }}" alt="" />
                  </a>
                  <p class="mb-3">
                    We are many variations of passages available but the majority have suffered alteration some form by injected humour
                    words believable.
                  </p>
                 
                  <div class="footer-newsletter">
                    <h6>Subscribe Our Newsletter</h6>
                    <div class="newsletter-form">
                      <form action="#">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-envelopes"></i>
                            <input type="email" class="form-control" placeholder="Your Email" />
                            <button class="theme-btn" type="submit">Subscribe <span class="far fa-paper-plane"></span></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-2">
                <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Company</h4>
                  <ul class="footer-list">
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>About Us</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Update News</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Testimonials</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Contact Us</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Terms Of Service</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Privacy policy</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-6 col-lg-2">
                <div class="footer-widget-box list">
                  <h4 class="footer-widget-title">Quick Links</h4>
                  <ul class="footer-list">
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Popular Courses</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Become Instructor</a>
                    </li>
                    <li>
                      <a href="{{route('instructor.login')}}"><i class="far fa-angle-double-right"></i>Instructor Login</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Help & Support</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Upcoming Events</a>
                    </li>
                    <li>
                      <a href="#"><i class="far fa-angle-double-right"></i>Our Affiliate</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="footer-widget-box">
                  <h4 class="footer-widget-title">Get In Touch</h4>
                  <ul class="footer-contact">
                    <li>
                      <div class="icon">
                        <i class="far fa-location-dot"></i>
                      </div>
                      <div class="content">
                        <h6>Our Address</h6>
                        <p>{{ $gs->address }}</p>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <i class="far fa-phone"></i>
                      </div>
                      <div class="content">
                        <h6>Call Us</h6>
                        <a href="tel:{{ $gs->number }}">{{ $gs->number }}</a>
                      </div>
                    </li>
                    <li>
                      <div class="icon">
                        <i class="far fa-envelope"></i>
                      </div>
                      <div class="content">
                        <h6>Mail Us</h6>
                        <a href="mailto:{{ $gs->email }}">{{ $gs->email }}</a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-payment mt-4">
              <h6>We Accept Payment Gateway</h6>
              <div class="payment-img">
                <img class="paypal" src="/assets/front/img/payment/paypal.png" alt="" />
                <img class="master" src="/assets/front/img/payment/master-card.png" alt="" />
                <img class="visa" src="/assets/front/img/payment/visa.png" alt="" />
                <img class="google" src="/assets/front/img/payment/google-pay.png" alt="" />
                <img class="apple" src="/assets/front/img/payment/apple-pay.png" alt="" />
                <img class="stripe" src="/assets/front/img/payment/stripe.png" alt="" />
                <img class="amex" src="/assets/front/img/payment/american-express.png" alt="" />
                <img class="discover" src="/assets/front/img/payment/discover.png" alt="" />
                <img class="amazon" src="/assets/front/img/payment/amazon-pay.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 align-self-center">
              <p class="copyright-text">&copy; Copyright <span id="date"></span> <a href="#"> {{ $gs->title }} </a> All Rights Reserved.</p>
            </div>
            <div class="col-md-6 align-self-center">
              <ul class="footer-social">
                 @if(!empty($gs->facebook))
                <li>
                  <a target="_blank" href="{{ $gs->facebook }}"><i class="fab fa-facebook-f"></i></a>
                </li>
                @endif
                
                @if(!empty($gs->instagram))
                <li>
                  <a target="_blank" href="{{ $gs->instagram }}"><i class="fab fa-instagram"></i></a>
                </li>
                @endif
                
                @if(!empty($gs->twitter))
                <li>
                  <a target="_blank" href="{{ $gs->twitter }}"><i class="fab fa-x-twitter"></i></a>
                </li>
                @endif
                
                @if(!empty($gs->linkedin))
                <li>
                  <a target="_blank" href="{{ $gs->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                </li>
                @endif

              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer area end -->