 @extends('front.layout.app')

@section('title')
Contact Us
@endsection

@section('main') 


    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img/breadcrumb/01.png)">
        <div class="container">
          <h2 class="breadcrumb-title">Contact Us</h2>
          <ul class="breadcrumb-menu">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li class="active">Contact Us</li>
          </ul>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- contact area -->
      <div class="contact-area pt-120 pb-100">
        <div class="container">
          <div class="contact-content pb-80">
            <div class="row">
              <div class="col-md-4">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-map-location-dot"></i>
                  </div>
                  <div class="content">
                    <h5>Office Address</h5>
                    <p>{{ $gs-> address }}</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-phone-volume"></i>
                  </div>
                  <div class="content">
                    <h5>Call Us</h5>
                    <p><a href="tel:{{ $gs->number }}">{{ $gs->number }}</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-envelopes"></i>
                  </div>
                  <div class="content">
                    <h5>Email Us</h5>
                    <p><a href="mailto:{{ $gs->email }}">{{ $gs->email }}</a></p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="contact-form-wrap">
            <div class="row g-4">
              <div class="col-lg-5">
                <div class="contact-img">
                  <img src="/assets/front/img/contact/01.jpg" alt="" />
                </div>
              </div>
              <div class="col-lg-7">
                <div class="contact-form">
                  <div class="contact-form-header" id="contact-form">
                    <h2>Get In Touch</h2>
                    <p>
                      It is a long established fact that a reader will be distracted by the readable content of a page randomised words
                      which don't look even slightly when looking at its layout.
                    </p>
                  </div>
                  <div class="form-message"></div>
                  <form method="post" action="{{ route('front.contactFrom') }}">
                      @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-user-tie"></i>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name*" value="{{ old('name') }}"  />
                            @error('name') 
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email*" value="{{ old('email') }}"  />
                            @error('email') 
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-phone"></i>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" pattern="\d+" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  value="{{ old('contact') }}" name="contact" placeholder="Your Contact Number*"  />
                            @error('contact') 
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                       </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-icon">
                            <i class="far fa-pen"></i>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Your Subject*" value="{{ old('subject') }}"  />
                            @error('subject') 
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                          </div>
                        </div>
                       </div>
                    </div>
                    <div class="form-group">
                      <div class="form-icon">
                        <i class="far fa-comment-lines"></i>
                        <textarea
                          name="message"
                          cols="30"
                          rows="5"
                          class="form-control @error('message') is-invalid @enderror"
                          placeholder="Write Your Message*"
                          
                        >{{ old('message') }}</textarea>
                         @error('message') 
                                  <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <button type="submit" class="theme-btn">Send Message <i class="far fa-paper-plane"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end contact area -->

      <!-- map -->
      <div class="contact-map pb-120">
        <div class="container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>
      <!-- map end -->
    </main>

  @endsection