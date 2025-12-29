 @extends('front.layout.app')

@section('title')
Course
@endsection

@section('main') 


    <main class="main">
      <!-- breadcrumb -->
      <div class="site-breadcrumb" style="background: url(/assets/front/img/breadcrumb/01.png)">
        <div class="container">
          <div class="col-lg-6">
            <div class="course-single-header">
              <div class="top">
                <span class="category">{{ $course->category->name }}</span>
                @if($course->subcategory->name)
                <span class="category">{{ $course->subcategory->name }}</span>
                @endif
              </div>
              <h4 class="title">{{ $course->name }}</h4>
              <p>{{ $course->excerpt }}</p>
              <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <span class="rating-avg">4.5</span>
                <span>({{ $course->reviews_count }} Reviews)</span>
              </div>
            @if(!empty($course->instructor))
              <div class="info">
                <div class="instructor">
                @if(!empty($course->instructor->image))
                  <img src="{{ asset('assets/front/images/instructor/'.$course->instructor->image) }}" alt="{{ $course->instructor->name }}" />
                @else
                  <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" alt="{{ $course->instructor->name ?? '' }}" />
                @endif
                  <h6>{{ $course->instructor->name ?? '' }}</h6>
                </div>
                <div class="update-date">
                  <h6>Last Updated: <span>{{ \Carbon\Carbon::parse($course->updated_at)->format('F j, Y') }}</span></h6>
                </div>
              </div>
            @endif
            </div>
          </div>
        </div>
      </div>
      <!-- breadcrumb end -->

      <!-- course-single -->
      <div class="course-single pt-50 pb-80">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 col-xl-8">
              <div class="course-single-wrap">
                <!--  video area -->
                <div class="video-area" 
                style="background-image: url({{ asset('assets/front/images/course/' . $course->image) }})">
                  <div class="row">
                    <div class="col-lg-12">
                         
<style>
  .video-wrap {
      position: relative;
      width: 100%;
      max-width: 900px; /* optional */
      margin: auto;
  }
  
  .video-wrap iframe {
      width: 100%;
      height: 480px;
      border: none;
      border-radius:25px;
      display:none;
  }
    
  .hide-icon {
      position: absolute;
      top: 0;
      right: 0;
      width: 70px;  
      height: 70px;
      background: transparent; 
      z-index: 99;
  }
</style>


<div class="video-wrap">
    <!--<div class="hide-icon"></div>-->
    <iframe id="googleVideoPlayer" allow="autoplay; fullscreen" allowfullscreen webkitallowfullscreen mozallowfullscreen >
    </iframe> 
    
    <iframe id="youtubeVideoPlayer" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    
</div>

                      
                     
                    </div>
                  </div>
                </div>
                <!-- video area end -->

                <!-- course single tab -->
                <div class="course-single-tab">
                  <ul class="nav nav-underline">
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab1" type="button">Description</button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#course-tab2" type="button">Curriculum</button>
                    </li>
                    @if(!empty($course->instructor))
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab3" type="button">Instructor</button>
                    </li>
                    @endif
                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab4" type="button">Review</button>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- tab 1 -->
                    <div class="tab-pane fade" id="course-tab1">
                      <div class="course-details mt-4">
                        {!! $course->description !!}
                      </div>
                    </div>

                    <!-- tab 2 -->
                    <div class="tab-pane fade active show" id="course-tab2">
                      <div class="course-curriculum mt-4">
                        <div class="accordion accordion-flush" id="course-accordion">
                        @php
                            $purchased = auth()->check() &&
                            \App\Models\CourseOrder::where('user_id', auth()->id())->where('course_id', $course->id)->exists();
                        @endphp

                        @foreach($course->syllabus as $data)
                        @if($data->lesson->count() != 0)
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#syllabus{{ $loop->iteration }}">
                                {{ $data->name }}
                              </button>
                            </h2>
                            <div id="syllabus{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->iteration == 1 ? 'show' : '' }}" data-bs-parent="#course-accordion">
                              <div class="accordion-body">
                                @foreach($data->lesson as $lesson)
                                <div class="curriculum-item {{ $purchased ? 'unlock' : '' }}"  data-lesson-id="{{ $lesson->id }}">
                                  <div class="left">
                                    <h6>
                                    @switch($lesson->file_type)
                                            @case('video')
                                            <i class="fad fa-play-circle"></i> 
                                                <span>Video:</span>
                                                @break
                                            @case('mcq')
                                            <i class="fad fa-file-alt"></i> 
                                                <span>MCQ:</span>
                                                @break
                                            @case('file')
                                            <i class="fad fa-file-alt"></i> 
                                                <span>File:</span>
                                                @break
                                            @default
                                            <i class="fad fa-check-circle"></i> 
                                                <span>Unknown:</span>
                                        @endswitch
                                        
                                        {{ $lesson->name }}</h6>
                                  </div>
                                  <div class="right">
                                    <span class="duration">
                                        @if($lesson->file_type == 'mcq')
                                            {{ \App\Models\Mcq::where('lesson_id', $lesson->id)->count() }}
                                        @else
                                            12:50
                                        @endif
                                    </span>

                                    <span class="lock">
                                    @if($purchased)
                                        <i class="fad fa-unlock"></i>
                                    @else
                                        <i class="fad fa-lock"></i>
                                    @endif
                                    </span>

                                  </div>
                                </div>
                                @endforeach
                                
                              </div>
                            </div>
                          </div>
                        @endif
                        @endforeach
                        </div>
                      </div>
                    </div>

                    <!-- tab 3 -->
                    <div class="tab-pane fade" id="course-tab3">
                      <div class="course-instructor mt-4">
                        <div class="instructor-img">
                        @if(!empty($course->instructor->image))
                          <img src="{{ asset('assets/front/images/instructor/'.$course->instructor->image) }}" alt="{{ $course->instructor->name }}" />
                        @else
                          <img src="{{ asset('assets/front/images/users/user-dummy-img.jpg') }}" alt="{{ $course->instructor->name ?? '' }}" />
                        @endif
                        </div>
                        <div class="instructor-info">
                          <h4>{{ $course->instructor->name ?? '' }}</h4>
                          <div class="instructor-info-wrap">
                            <div class="rating">
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <i class="fas fa-star"></i>
                              <span>(4.5)</span>
                            </div>
                            <span class="course"><i class="fad fa-book-open"></i> 15 Courses</span>
                            <span class="enrolled"><i class="fad fa-user-friends"></i> 1.5k Enrolled</span>
                          </div>
                          <p>
                            There are many variations of passages orem psum available but the majority have suffered alteration in some
                            form, by injected humour.
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- tab 4 -->
                    <div class="tab-pane fade" id="course-tab4">
                      <div class="course-review">
                        <div class="review-wrap mt-4">
                          <!-- review-rating -->
                          <div class="review-rating">
                            <div class="rating-count">
                              <h2>4.5</h2>
                              <div class="rating-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                              </div>
                              <p>15.5k Students Review</p>
                            </div>
                            <div class="rating-range">
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 90%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>90%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 80%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>80%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 59%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>59%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 70%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>70%</span>
                                </div>
                              </div>
                              <div class="rating-range-item">
                                <div class="rating-range-star">
                                  <i class="fas fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                  <i class="far fa-star"></i>
                                </div>
                                <div class="rating-range-bar">
                                  <div class="progress">
                                    <div class="progress-width" style="width: 49%"></div>
                                  </div>
                                </div>
                                <div class="rating-range-percentage">
                                  <span>49%</span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- review-content -->
                          <div class="review-content">
                            <h5 class="title">Reviews (1,500)</h5>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-2.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="review-item">
                              <div class="review-author">
                                <img src="/assets/front/img/instructor/rev-1.png" alt="" />
                                <div class="info">
                                  <div>
                                    <h6>Erich T. Genao</h6>
                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                  </div>
                                  <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                  </div>
                                </div>
                              </div>
                              <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by
                                injected humour randomised words. It is a long established fact that reader will be distracted by the
                                readable content of web page editors now use page when looking at its layout.
                              </p>
                            </div>
                            <div class="text-center mt-4">
                              <a href="#" class="theme-btn"> <span class="fas fa-sync-alt"></span> Load More</a>
                            </div>
                          </div>

                          <!-- review-form -->
                          <div class="review-form">
                            <h5>Leave A Review</h5>
                            <form action="#">
                              <div class="form-group">
                                <label class="form-label">Your Rating</label>
                                <select class="form-select">
                                  <option value="">Choose Your Rating</option>
                                  <option value="5">5 Stars</option>
                                  <option value="4">4 Stars</option>
                                  <option value="3">3 Stars</option>
                                  <option value="2">2 Stars</option>
                                  <option value="1">1 Star</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="form-label">Your Review</label>
                                <textarea class="form-control" cols="30" rows="5" placeholder="Write your review"></textarea>
                              </div>
                              <button class="theme-btn" type="button">Post Your Review<i class="far fa-arrow-right"></i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- course single tab end -->
              </div>
            </div>
            <div class="col-lg-5 col-xl-4">
              <!-- course-single-sidebar -->
              <div class="course-single-sidebar" style="position:sticky;top:10%">
                @php
                    $isPurchased = \App\Models\CourseOrder::where('user_id', auth()->id())->where('course_id', $course->id)->exists();
                @endphp
                @if($isPurchased)
               
                    <a href="{{ route('front.course-single2', $course->slug) }}" class="theme-btn"><span class="fad fa-play-circle"></span> Start Now</a>
                @else
                
                    @if($course->price == 'paid')
                    <div class="price-wrap">
                      <div class="price-amount"><span>${{ $course->sale_price }}</span><del>${{ $course->old_price }}</del></div>
                      <span class="price-off">{{ round((($course->old_price - $course->sale_price) / $course->old_price) * 100) }}% Off</span>
                    </div>
                    
                    <a href="javascript:void(0)" class="theme-btn addToCart" data-course-id="{{ $course->id }}">
                      <span class="far fa-shopping-bag"></span> Add To Cart
                    </a>
                    @else
                    <a href="javascript:void(0)" class="theme-btn">
                      <span class="fad fa-check-circle"></span> Free
                    </a>
                    @endif
                
                @endif
                
                <div class="more-info">
                  <ul>
                    @if(!empty($course->instructor))
                    <li><i class="fad fa-user"></i> Instructor: <span>{{ $course->instructor->name ?? '' }}</span></li>
                    @endif
                    <li><i class="fad fa-layer-group"></i> Level : <span>Expert</span></li>
                    <li><i class="fad fa-book"></i> Lectures : <span>35 Lectures</span></li>
                    <li><i class="fad fa-clock"></i> Duration: <span>03 Months</span></li>
                    <li><i class="fad fa-user-friends"></i> Enrolled: <span>259 Students</span></li>
                    <li><i class="fad fa-globe"></i> Language: <span>English</span></li>
                  </ul>
                </div>
                
                @if(!empty($course->benefit))
                <div class="include">
                  <h5>Course Includes</h5>
                  <ul>
                    @foreach(explode("\n", $course->benefit ?? '') as $line)
                        @if(trim($line) != '')
                            <li>
                                <i class="fad fa-check-circle"></i> 
                                {{ trim($line) }}
                            </li>
                        @endif
                    @endforeach
                  </ul>
                </div>
                @endif
                
                <div class="share">
                  <h5>Social Share</h5>
                  <div class="share-link">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- course-single end -->

      <!-- related course -->
      <div class="course-area pb-120">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <div class="site-heading text-center">
                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Courses</span>
                <h2 class="site-title">Most Related <span class="text-gradient">Courses</span></h2>
              </div>
            </div>
          </div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="course-item">
                <span class="course-tag c1">Beginer</span>
                <div class="course-img">
                  <a href="{{ route('front.course-single', 'course-details') }}"><img src="/assets/front/img/course/01.jpg" alt="" /></a>
                </div>
                <div class="course-content">
                  <div class="course-meta">
                    <span class="category c1">Development</span>
                    <div class="rating">
                      <i class="fas fa-star"></i>
                      <span>3.5k</span>
                    </div>
                  </div>
                  <h4 class="course-title"><a href="{{ route('front.course-single', 'course-details') }}">Advance PHP Knowledge and learn Laravel framework</a></h4>
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
                      <del>$75</del>
                      <span>$69</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="course-item">
                <span class="course-tag c2">Advance</span>
                <div class="course-img">
                  <a href="{{ route('front.course-single', 'course-details') }}"><img src="/assets/front/img/course/02.jpg" alt="" /></a>
                </div>
                <div class="course-content">
                  <div class="course-meta">
                    <span class="category">Art & Design</span>
                    <div class="rating">
                      <i class="fas fa-star"></i>
                      <span>5.2k</span>
                    </div>
                  </div>
                  <h4 class="course-title">
                    <a href="{{ route('front.course-single', 'course-details') }}">Full Web Designing Course With 20 Web Template</a>
                  </h4>
                  <div class="course-info">
                    <ul>
                      <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                      <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                    </ul>
                  </div>
                  <div class="course-bottom">
                    <a href="#">
                      <div class="course-instructor">
                        <img src="/assets/front/img/course/ins-2.jpg" alt="" />
                        <h6>Michel Johny</h6>
                      </div>
                    </a>
                    <div class="course-price">
                      <span>$125</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="course-item">
                <span class="course-tag c1">Beginer</span>
                <div class="course-img">
                  <a href="{{ route('front.course-single', 'course-details') }}"><img src="/assets/front/img/course/03.jpg" alt="" /></a>
                </div>
                <div class="course-content">
                  <div class="course-meta">
                    <span class="category c2">Business</span>
                    <div class="rating">
                      <i class="fas fa-star"></i>
                      <span>2.9k</span>
                    </div>
                  </div>
                  <h4 class="course-title"><a href="{{ route('front.course-single', 'course-details') }}">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                  <div class="course-info">
                    <ul>
                      <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                      <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                    </ul>
                  </div>
                  <div class="course-bottom">
                    <a href="#">
                      <div class="course-instructor">
                        <img src="/assets/front/img/course/ins-3.jpg" alt="" />
                        <h6>Glines Joey</h6>
                      </div>
                    </a>
                    <div class="course-price">
                      <span>$130</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
              <div class="course-item">
                <span class="course-tag c2">Advance</span>
                <div class="course-img">
                  <a href="{{ route('front.course-single', 'course-details') }}"><img src="/assets/front/img/course/04.jpg" alt="" /></a>
                </div>
                <div class="course-content">
                  <div class="course-meta">
                    <span class="category c3">IT & Software</span>
                    <div class="rating">
                      <i class="fas fa-star"></i>
                      <span>9k</span>
                    </div>
                  </div>
                  <h4 class="course-title">
                    <a href="{{ route('front.course-single', 'course-details') }}">The Complete Business Plan Course Includes 50 Templates</a>
                  </h4>
                  <div class="course-info">
                    <ul>
                      <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                      <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                    </ul>
                  </div>
                  <div class="course-bottom">
                    <a href="#">
                      <div class="course-instructor">
                        <img src="/assets/front/img/course/ins-4.html" alt="" />
                        <h6>Nancy Alarcon</h6>
                      </div>
                    </a>
                    <div class="course-price">
                      <span>$142</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- related course end -->
    </main>

   @endsection
@section('scripts')
<script>


$(document).on('click', '.curriculum-item', function () {
    console.log('clicked');

    let lessonId = $(this).data('lesson-id');

    $('#youtubeVideoPlayer').hide().attr('src', '');
    $('#googleVideoPlayer').hide().attr('src', '');

    $.ajax({
        url: `/lesson/video/${lessonId}`,
        method: 'GET',

        success: function (res) {

            if (res.redirect) {
                window.location.href = res.redirect;
                return;
            }
            
            $('.video-area').css('background-image', 'none');

            if (res.type === 'youtube') {
                $('#youtubeVideoPlayer')
                    .attr('src', res.url)
                    .show();
            } 
            else if (res.type === 'google') {
                $('#googleVideoPlayer')
                    .attr('src', res.url)
                    .show();
            }
        },

        error: function (xhr) {
            let msg = xhr.responseJSON?.message || 'Something went wrong';

            if (xhr.status === 401) {
                ErrorAlert(msg);
                window.location.href = '/login';
                return;
            }

            ErrorAlert(msg);
        }
    });
});

$('.curriculum-item.unlock:first-child').trigger('click');
</script>



@endsection

@section('script')  
                <script>
                  

    </script>
 

@endsection