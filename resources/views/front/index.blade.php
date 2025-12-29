@extends('front.layout.app')

@section('title')
Home
@endsection

@section('main') 

    <main class="main">
      <!-- hero area -->
      <div class="hero-section hs-1">
        <div class="hero-single" style="background-image: url(/assets/front/img/shape/01.png)">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="hero-content">
                  <h6 class="hero-sub-title wow fadeInUp" data-delay=".25s"><i class="far fa-lightbulb-on"></i> Start To New Journey</h6>
                  <h1 class="hero-title wow fadeInRight" data-delay=".50s">Best learning <span class="text-gradient">platform that take</span> you next level</h1>
                  <p class="wow fadeInLeft" data-delay=".75s">
                    There are many variations of passages orem psum available but the majority have suffered alteration in some form by
                    injected humour.
                  </p>
                  <div class="hero-btn wow fadeInUp" data-delay="1s">
                    <a href="about.html" class="theme-btn">About More<i class="fas fa-arrow-right"></i></a>
                    <a href="contact.html" class="theme-btn2">Learn More<i class="fas fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="hero-info-wrap">
                  <div class="hero-avatar-group">
                    <h6><span>250k +</span> Students</h6>
                    <span class="avatar"><img src="/assets/front/img/account/01.html" alt="" /></span>
                    <span class="avatar"><img src="/assets/front/img/account/02.jpg" alt="" /></span>
                    <span class="avatar"><img src="/assets/front/img/account/03.jpg" alt="" /></span>
                    <span class="avatar"><img src="/assets/front/img/account/04.jpg" alt="" /></span>
                    <span class="avatar"><img src="/assets/front/img/account/05.jpg" alt="" /></span>
                  </div>
                  <div class="hero-course-info">
                    <div class="icon">
                      <img src="/assets/front/img/icon/course.svg" alt="" />
                    </div>
                    <h6 class="title"><span>160+</span> Courses</h6>
                  </div>
                </div>
                <div class="hero-img">
                  <img class="img-1" src="/assets/front/img/hero/01.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- hero area end -->

      <!-- partner area -->
      <div class="partner-area2 negative">
        <div class="col-lg-10 col-xl-9 ms-auto">
          <div class="partner-wrapper">
            <div class="row g-4 align-items-center">
              <div class="col-lg-2">
                <div class="partner-title">
                  <h5>Let's check our <span>350+</span> partners</h5>
                </div>
              </div>
              <div class="col-lg-10">
                <div class="partner-slider owl-carousel owl-theme">
                  <img src="/assets/front/img/partner/01.png" alt="thumb" />
                  <img src="/assets/front/img/partner/02.png" alt="thumb" />
                  <img src="/assets/front/img/partner/03.png" alt="thumb" />
                  <img src="/assets/front/img/partner/04.png" alt="thumb" />
                  <img src="/assets/front/img/partner/05.png" alt="thumb" />
                  <img src="/assets/front/img/partner/06.png" alt="thumb" />
                  <img src="/assets/front/img/partner/07.html" alt="thumb" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- partner area end -->

      <!-- about area -->
      <div class="about-area py-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                <div class="about-img">
                  <div class="row g-0">
                    <div class="col-6">
                      <img class="img-1" src="/assets/front/img/about/01.jpg" alt="" />
                    </div>
                    <div class="col-6">
                      <img class="img-2" src="/assets/front/img/about/02.jpg" alt="" />
                    </div>
                  </div>
                </div>
                <div class="about-experience">
                  <h5>30<span>+</span></h5>
                  <p>Years Of Experience</p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-right wow fadeInUp" data-wow-delay=".25s">
                <div class="site-heading mb-3">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> About Us</span>
                  <h2 class="site-title">Whether you want <span class="text-gradient">to learn or share</span> what you know</h2>
                </div>
                <p class="about-text">
                  There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by
                  injected humour, or randomised words which don't look even.
                </p>
                <div class="about-content">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="about-item">
                        <div class="icon">
                          <img src="/assets/front/img/icon/learn.svg" alt="" />
                        </div>
                        <div class="content">
                          <h6>Flexible Learning</h6>
                          <p>Take a look at our up of the round shows</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="about-item">
                        <div class="icon">
                          <img src="/assets/front/img/icon/support.svg" alt="" />
                        </div>
                        <div class="content">
                          <h6>24/7 Live Support</h6>
                          <p>Take a look at our up of the round shows</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <a href="about.html" class="theme-btn">Discover More<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- about area end -->

      <!-- category area -->
      <div class="category-area pb-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Category</span>
                <h2 class="site-title">Let's check our <span class="text-gradient">category</span></h2>
              </div>
            </div>
          </div>
          <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay=".25s">
        @foreach($category as $cat)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
              <a href="{{ route('front.course', ['category' => $cat->slug]) }}" class="category-item">
                <div class="content">
                  <div class="icon">
                    <img src="{{ asset('assets/front/images/category/' . $cat['image']) }}" alt="{{ $cat->name }}" />
                  </div>
                  <div class="info">
                    <h6>{{ $cat->name }}</h6>
                    <p>{{ $cat->course_count }} Courses</p>
                  </div>
                </div>
              </a>
            </div>
        @endforeach
          </div>
          <!--<div class="col-12 text-center">-->
          <!--  <a href="course-category.html" class="theme-btn mt-5"><span class="fad fa-rotate"></span> All Category</a>-->
          <!--</div>-->
        </div>
      </div>
      <!-- category area end -->

      <!-- course area -->
      <div class="course-area bg-img py-80">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Courses</span>
                <h2 class="site-title">Our Most Popular <span class="text-gradient">Courses</span></h2>
              </div>
            </div>
          </div>
          <div class="course-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            
                   
                @foreach($courses as $course)
                
                @php
                    if($course->tag == 'New'){
                        $tagClass = 'c1';
                    }elseif($course->tag == 'Premium'){
                        $tagClass = 'c2';
                    }else{
                        $tagClass = 'c3';
                    }
                @endphp
                 
                  <div class="course-item">
                    <span class="course-tag {{ $tagClass }}">{{ $course->tag }}</span>
                    <div class="course-img">
                      <a href="{{ route('front.course-single', $course->slug) }}"><img src="{{ asset('assets/front/images/course/' . $course->image) }}" alt="{{ $course->name }}" /></a>
                    </div>
                    <div class="course-content">
                      <div class="course-meta">
                        <span class="category c1">{{ $course->category->name }}</span>
                        
                        @if($course->reviews_count > 0)
                        <div class="rating">
                          <i class="fas fa-star"></i>
                          <span>{{ $course->reviews_count }}</span>
                        </div>
                        @endif
                        
                      </div>
                      <h4 class="course-title"><a href="{{ route('front.course-single', $course->slug) }}">{{ Str::limit($course->name, 50, '...') }}</a></h4>
                      <div class="course-info">
                        <ul>
                          <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                          <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                        </ul>
                      </div>
                      <div class="course-bottom">
                        <a href="#">
                          <div class="course-instructor">
                            <img src="/assets/front/img/course/ins-1.jpg" alt="" />
                            <h6>Sara Wood</h6>
                          </div>
                        </a>
                        <div class="course-price">
                            @if($course->price == 'free')
                                <button class="btn-sm theme-btn p-0 ps-3 pe-3">Free</button>
                            @else
                                <del>${{ $course->old_price }}</del>
                                <span>${{ $course->sale_price }}</span>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                
                @endforeach
                   
                 
              </div>
          </div>
        </div>
      </div>
      <!-- course area end -->

      <!-- choose area -->
      <div class="choose-area py-120">
        <div class="container">
          <div class="row g-4">
            <div class="col-lg-6">
              <div class="choose-content wow fadeInLeft" data-wow-delay=".25s">
                <div class="site-heading mb-0">
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Why Choose Us</span>
                  <h2 class="site-title">We deliver <span class="text-gradient">expertise you can trust</span> our service</h2>
                  <p>
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its
                    layout.
                  </p>
                  <div class="choose-img">
                    <img src="/assets/front/img/choose/01.jpg" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="row g-4 wow fadeInRight" data-wow-delay=".25s">
                <div class="col-lg-6">
                  <div class="choose-item">
                    <div class="icon">
                      <img src="/assets/front/img/icon/money.svg" alt="" />
                    </div>
                    <div class="info">
                      <h5>Affordable Cost</h5>
                      <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">
                    <div class="icon">
                      <img src="/assets/front/img/icon/instructor.svg" alt="" />
                    </div>
                    <div class="info">
                      <h5>Expert Instructors</h5>
                      <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">
                    <div class="icon">
                      <img src="/assets/front/img/icon/training.svg" alt="" />
                    </div>
                    <div class="info">
                      <h5>Flexible Learning</h5>
                      <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="choose-item">
                    <div class="icon">
                      <img src="/assets/front/img/icon/community.svg" alt="" />
                    </div>
                    <div class="info">
                      <h5>Supportive Community</h5>
                      <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- choose area end -->

      <!-- counter area -->
      <div class="counter-area">
        <div class="counter-wrap">
          <div class="col-lg-11 ms-lg-auto">
            <div class="row g-4">
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                  <div class="icon">
                    <img src="/assets/front/img/icon/student.svg" alt="" />
                  </div>
                  <div class="content">
                    <div class="info">
                      <span class="counter" data-count="+" data-to="150" data-speed="3000">150</span>
                      <span class="unit">k</span>
                    </div>
                    <h6 class="title">Students Enrolled</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                  <div class="icon">
                    <img src="/assets/front/img/icon/course-2.svg" alt="" />
                  </div>
                  <div class="content">
                    <div class="info">
                      <span class="counter" data-count="+" data-to="25" data-speed="3000">25</span>
                      <span class="unit">K</span>
                    </div>
                    <h6 class="title">Total Courses</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                  <div class="icon">
                    <img src="/assets/front/img/icon/instructor-2.svg" alt="" />
                  </div>
                  <div class="content">
                    <div class="info">
                      <span class="counter" data-count="+" data-to="120" data-speed="3000">120</span>
                      <span class="unit">+</span>
                    </div>
                    <h6 class="title">Expert Tutors</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                  <div class="icon">
                    <img src="/assets/front/img/icon/award.svg" alt="" />
                  </div>
                  <div class="content">
                    <div class="info">
                      <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                      <span class="unit">+</span>
                    </div>
                    <h6 class="title">Win Awards</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- counter area end -->



      <!-- feature-area -->
      <div class="feature-area pb-120">
        <div class="container">
          <div class="feature-wrap">
            <div class="row g-4">
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                  <div class="feature-content">
                    <span class="count">01</span>
                    <div class="feature-icon">
                      <img src="/assets/front/img/icon/course-3.svg" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>25k Online Course</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".35s">
                  <div class="feature-content">
                    <span class="count">02</span>
                    <div class="feature-icon">
                      <img src="/assets/front/img/icon/instructor-3.svg" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>Expert Instructors</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="feature-item wow fadeInUp" data-wow-delay=".45s">
                  <div class="feature-content">
                    <span class="count">03</span>
                    <div class="feature-icon">
                      <img src="/assets/front/img/icon/lifetime-course.svg" alt="" />
                    </div>
                    <div class="feature-info">
                      <h4>Lifetime Access</h4>
                      <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- feature-area end -->

      <!-- video-area -->
      <div class="video-area pb-120">
        <div class="container">
          <div class="row g-4 align-items-center">
            <div class="col-lg-4">
              <div class="site-heading mb-0 wow fadeInLeft" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Latest Video</span>
                <h2 class="site-title">What <span class="text-gradient">makes us different</span> check our video</h2>
                <p>
                  There are many variations of passages available but the majority have suffered alteration in some form by even slightly
                  you are going to believable.
                </p>
                <a href="about.html" class="theme-btn mt-20">Learn More <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="video-content wow fadeInRight" data-wow-delay=".25s" style="background-image: url('/assets/front/img/video/01.jpg')">
                <div class="row align-items-center">
                  <div class="col-lg-12">
                    <div class="video-wrap">
                      <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=jLS3DrTJrpI">
                        <i class="fas fa-play"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- video-area end -->

      <!-- instructor -->
      <div class="instructor pb-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Instructors</span>
                <h2 class="site-title">Meet Our Best <span class="text-gradient">Instructors</span></h2>
              </div>
            </div>
          </div>
          <div class="row g-4 wow fadeInUp" data-wow-delay=".25s">
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="instructor-item">
                <div class="instructor-img">
                  <img src="/assets/front/img/instructor/01.jpg" alt="" />
                </div>
                <div class="instructor-content">
                  <h5><a href="instructor-single.html">Mary Dusser</a> <span class="far fa-badge-check"></span></h5>
                  <p>Software Engineer</p>
                  <div class="info">
                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                  </div>
                </div>
                <div class="instructor-bottom">
                  <div class="price">
                    <span class="text">Start From</span>
                    <span class="amount">$150</span>
                  </div>
                  <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="instructor-item">
                <div class="instructor-img">
                  <img src="/assets/front/img/instructor/02.jpg" alt="" />
                </div>
                <div class="instructor-content">
                  <h5><a href="instructor-single.html">Hector Nickel</a> <span class="far fa-badge-check"></span></h5>
                  <p>UI/UX Designer</p>
                  <div class="info">
                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                  </div>
                </div>
                <div class="instructor-bottom">
                  <div class="price">
                    <span class="text">Start From</span>
                    <span class="amount">$150</span>
                  </div>
                  <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="instructor-item">
                <div class="instructor-img">
                  <img src="/assets/front/img/instructor/03.jpg" alt="" />
                </div>
                <div class="instructor-content">
                  <h5><a href="instructor-single.html">Karin Chumley</a> <span class="far fa-badge-check"></span></h5>
                  <p>Business Analyst</p>
                  <div class="info">
                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                  </div>
                </div>
                <div class="instructor-bottom">
                  <div class="price">
                    <span class="text">Start From</span>
                    <span class="amount">$150</span>
                  </div>
                  <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="instructor-item">
                <div class="instructor-img">
                  <img src="/assets/front/img/instructor/04.jpg" alt="" />
                </div>
                <div class="instructor-content">
                  <h5><a href="instructor-single.html">Avendano Kean</a> <span class="far fa-badge-check"></span></h5>
                  <p>Frontend Engineer</p>
                  <div class="info">
                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                  </div>
                </div>
                <div class="instructor-bottom">
                  <div class="price">
                    <span class="text">Start From</span>
                    <span class="amount">$150</span>
                  </div>
                  <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- instructor end -->

      <!-- course tab -->
      <div class="course-tab pb-120">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="site-heading inline">
                <div>
                  <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Courses</span>
                  <h2 class="site-title">Courses By <span class="text-gradient">Category</span></h2>
                </div>
                <ul class="nav nav-pills" id="pills-tab">
                 <li class="nav-item">
                    <a href="#" class="nav-link active" id="" data-bs-toggle="pill" data-bs-target="#pills-0">All</a>
                  </li>
                    @foreach($category as $cat)
                  <li class="nav-item">
                    <a href="#" class="nav-link" id="" data-bs-toggle="pill" data-bs-target="#pills-{{ $cat->id  }}">{{ $cat->name }}</a>
                  </li>
                  @endforeach
                   
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-0">
              <div class="row g-4">
                   
                @foreach($courses as $course)
                
                @php
                    if($course->tag == 'New'){
                        $tagClass = 'c1';
                    }elseif($course->tag == 'Premium'){
                        $tagClass = 'c2';
                    }else{
                        $tagClass = 'c3';
                    }
                @endphp
                  
                <div class="col-md-6 col-lg-4 col-xl-3">
                  <div class="course-item">
                    <span class="course-tag {{ $tagClass }}">{{ $course->tag }}</span>
                    <div class="course-img">
                      <a href="{{ route('front.course-single', $course->slug) }}"><img src="{{ asset('assets/front/images/course/' . $course->image) }}" alt="{{ $course->name }}" /></a>
                    </div>
                    <div class="course-content">
                      <div class="course-meta">
                        <span class="category c1">{{ $course->category->name }}</span>
                        
                        @if($course->reviews_count > 0)
                        <div class="rating">
                          <i class="fas fa-star"></i>
                          <span>{{ $course->reviews_count }}</span>
                        </div>
                        @endif
                        
                      </div>
                      <h4 class="course-title"><a href="{{ route('front.course-single', $course->slug) }}">{{ Str::limit($course->name, 50, '...') }}</a></h4>
                      <div class="course-info">
                        <ul>
                          <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                          <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                        </ul>
                      </div>
                      <div class="course-bottom">
                        <a href="#">
                          <div class="course-instructor">
                            <img src="/assets/front/img/course/ins-1.jpg" alt="" />
                            <h6>Sara Wood</h6>
                          </div>
                        </a>
                        <div class="course-price">
                            @if($course->price == 'free')
                                <button class="btn-sm theme-btn p-0 ps-3 pe-3">Free</button>
                            @else
                                <del>${{ $course->old_price }}</del>
                                <span>${{ $course->sale_price }}</span>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                @endforeach
                   
                 
              </div>
            </div>
            @foreach($category as $cat)
            <div class="tab-pane fade" id="pills-{{ $cat->id }}">
                <div class="row g-4">
            
                    @foreach($cat->course as $course)
            
                    @php
                        if($course->tag == 'New'){
                            $tagClass = 'c1';
                        }elseif($course->tag == 'Premium'){
                            $tagClass = 'c2';
                        }else{
                            $tagClass = 'c3';
                        }
                    @endphp
            
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="course-item">
                            <span class="course-tag {{ $tagClass }}">{{ $course->tag }}</span>
                            <div class="course-img">
                                <a href="{{ route('front.course-single', $course->slug) }}">
                                    <img src="{{ asset('assets/front/images/course/' . $course->image) }}" alt="{{ $course->name }}" />
                                </a>
                            </div>
                            <div class="course-content">
                                <div class="course-meta">
                                    <span class="category c1">{{ $course->category->name }}</span>
            
                                    @if($course->reviews_count > 0)
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <span>{{ $course->reviews_count }}</span>
                                    </div>
                                    @endif
            
                                </div>
                                <h4 class="course-title"><a href="{{ route('front.course-single', $course->slug) }}">{{ Str::limit($course->name, 50, '...') }}</a></h4>
                                <div class="course-info">
                                    <ul>
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="#">
                                        <div class="course-instructor">
                                            <img src="/assets/front/img/course/ins-1.jpg" alt="" />
                                            <h6>Sara Wood</h6>
                                        </div>
                                    </a>
                                    <div class="course-price">
                                        @if($course->price == 'free')
                                            <button class="btn-sm theme-btn p-0 ps-3 pe-3">Free</button>
                                        @else
                                            <del>${{ $course->old_price }}</del>
                                            <span>${{ $course->sale_price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    @endforeach
            
                </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
      <!-- course tab end -->

      <!-- cta area -->
      <div class="cta-area pb-120">
        <div class="container">
          <div class="cta-wrap">
            <div class="row align-items-center">
              <div class="col-lg-6 col-xl-5">
                <div class="cta-content wow fadeInUp" data-wow-delay=".25s">
                  <h1>Get access <span>2,550+</span> of our top courses</h1>
                  <p>It is long established fact that reader will by the content of page when looking at its layout.</p>
                  <a href="contact.html" class="theme-btn">Get Started<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-xl-7">
                <div class="cta-img">
                  <img src="/assets/front/img/cta/01.jpg" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- cta area end -->

      <!-- process area -->
      <div class="process-area pb-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Working Process</span>
                <h2 class="site-title">Easy steps for <span class="text-gradient">start Learning</span></h2>
              </div>
            </div>
          </div>
          <div class="process-wrap wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">01</span>
                  <div class="icon">
                    <img src="/assets/front/img/icon/learn.svg" alt="" />
                  </div>
                  <div class="content">
                    <h4>Find & Enroll Course</h4>
                    <p>It is a long established fact the readable content of a page.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">02</span>
                  <div class="icon">
                    <img src="/assets/front/img/icon/course-2.svg" alt="" />
                  </div>
                  <div class="content">
                    <h4>Start Your Course</h4>
                    <p>It is a long established fact the readable content of a page.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4">
                <div class="process-item">
                  <span class="count">03</span>
                  <div class="icon">
                    <img src="/assets/front/img/icon/expert.svg" alt="" />
                  </div>
                  <div class="content">
                    <h4>Become Master</h4>
                    <p>It is a long established fact the readable content of a page.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- process area end -->

      <!-- skill-area -->
      <div class="skill-area pb-120">
        <div class="container">
          <div class="skill-wrap">
            <div class="row g-4 align-items-center">
              <div class="col-lg-6">
                <div class="skill-img wow fadeInLeft" data-wow-delay=".25s">
                  <img src="/assets/front/img/skill/01.jpg" alt="thumb" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="skill-content wow fadeInUp" data-wow-delay=".25s">
                  <div class="site-heading mb-4">
                    <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Skills</span>
                    <h2 class="site-title">Getting Best <span class="text-gradient">Quality Education</span> Is More Easy</h2>
                    <p class="skill-text">
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some
                      form, by injected humour, or randomised words which don't look even slightly believable.
                    </p>
                  </div>
                  <div class="skill-progress">
                    <div class="progress-item">
                      <h5>Happy Students <span class="percent">85%</span></h5>
                      <div class="progress" data-value="85">
                        <div class="progress-bar" role="progressbar"></div>
                      </div>
                    </div>
                    <div class="progress-item">
                      <h5>Students Engaging <span class="percent">65%</span></h5>
                      <div class="progress" data-value="65">
                        <div class="progress-bar" role="progressbar"></div>
                      </div>
                    </div>
                    <div class="progress-item">
                      <h5>Supportive Community <span class="percent">75%</span></h5>
                      <div class="progress" data-value="75">
                        <div class="progress-bar" role="progressbar"></div>
                      </div>
                    </div>
                  </div>
                  <a href="about.html" class="theme-btn mt-5">Learn More<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- skill area end -->

      <!-- testimonial-area -->
      <div class="testimonial-area ts-bg pt-80 pb-70">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Testimonials</span>
                <h2 class="site-title">What Our Client <span class="text-gradient">Say's About Us</span></h2>
              </div>
            </div>
          </div>
          <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="/assets/front/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="/assets/front/img/testimonial/01.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Niesha Phips</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="/assets/front/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="/assets/front/img/testimonial/02.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Eugene Ivan</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="/assets/front/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="/assets/front/img/testimonial/03.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Martha Brown</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="/assets/front/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="/assets/front/img/testimonial/04.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Robert Dese</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-item">
              <div class="content">
                <div class="icon">
                  <img src="/assets/front/img/icon/quote.svg" alt="" />
                </div>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="quote">
                  <p>
                    There are many variations of passage available the majority have suffered of alteration of the some humour words look
                    even slightly form by the injected to default model believable.
                  </p>
                </div>
                <div class="author">
                  <div class="author-img">
                    <img src="/assets/front/img/testimonial/05.jpg" alt="" />
                  </div>
                  <div class="author-info">
                    <h5>Buchan Conie</h5>
                    <p>Student</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- testimonial-area end -->

      <!-- blog-area -->
      <div class="blog-area py-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
              </div>
            </div>
          </div>
          <div class="blog-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                  @foreach( $blog as $data) 
              <div class="blog-item">
                <div class="blog-date">{{ \Carbon\Carbon::parse($data->created_at)->format('M j, Y') }}</div>
                <div class="blog-img">
                  <a href="{{ route('front.blog-single' , $data->slug ) }}"><img src="{{ asset('assets/front/images/blog/'.$data->image) }}" alt="{{ $data->alt }}" class="blog-thumb" /></a>
                </div>
                 
                <div class="blog-info mt-3">
                  <h4 class="blog-title">
                    <a class="title-text" href="{{ route('front.blog-single' , $data->slug ) }}">{{ $data->title }}</a>
                  </h4>
                  <p class="excerpt-text">{{ $data->excerpt }}</p>
                  <a class="theme-btn" href="{{ route('front.blog-single' , $data->slug ) }}">Read More<i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
           
           
             @endforeach
           </div>
        </div>
      </div>
      <!-- blog-area end -->

      <!-- download area -->
      <div class="download-area mb-120">
        <div class="container">
          <div class="download-wrap wow fadeInUp" data-wow-delay=".25s">
            <div class="row">
              <div class="col-lg-6 align-self-center">
                <div class="download-content">
                  <div class="site-heading mb-4">
                    <span class="site-title-tagline justify-content-start"> <i class="far fa-lightbulb-on"></i> Download Our App </span>
                    <h2 class="site-title mb-10">Edubo Android <span class="text-gradient">and IOS App is</span> Available!</h2>
                    <p>
                      There are many variations of passages available but the majority have suffered in some form going to use a passage by
                      injected humour.
                    </p>
                  </div>
                  <div class="download-btn">
                    <a href="#" class="google-play">
                      <i class="fab fa-google-play"></i>
                      <div class="content">
                        <span>Get It On</span>
                        <h6>Google Play</h6>
                      </div>
                    </a>
                    <a href="#" class="app-store">
                      <i class="fab fa-app-store"></i>
                      <div class="content">
                        <span>Get It On</span>
                        <h6>App Store</h6>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="download-img">
                  <img src="/assets/front/img/download/01.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- download end -->
    </main>
 
@endsection