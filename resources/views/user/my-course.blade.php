   @extends('front.layout.app')
@section('title')
Forget Password
@endsection
@section('main')


    <main class="main">
      

      <!-- user wishlist -->
      <div class="user-account py-70">
        <div class="container">
          <div class="row g-4">
            @include('user.layout.sidebar')
            <div class="col-lg-8 col-xl-9">
              <div class="user-wrapper course-border">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="user-card user-course">
                      <div class="header">
                        <h4 class="title">My Courses</h4>
                        <div class="right">
                          <div class="filter">
                            <select class="select">
                              <option value="">Default</option>
                              <option value="1">Pending</option>
                              <option value="2">Completed</option>
                            </select>
                          </div>
                          <div class="search">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Search..." />
                              <i class="far fa-search"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row g-4 mt-2">
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item pending">
                            <span class="course-tag c1">Beginer</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/01.jpg" alt="" /></a>
                            </div>
                            <div class="course-content">
                              <div class="course-meta">
                                <span class="category c1">Development</span>
                                <div class="rating">
                                  <i class="fas fa-star"></i>
                                  <span>3.5k</span>
                                </div>
                              </div>
                              <h4 class="course-title">
                                <a href="course-single.html">Advance PHP and learn Laravel framework</a>
                              </h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 75%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-1.jpg" alt="" />
                                    <h6>Sara Wood</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>75% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Finish Course</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item finished">
                            <span class="course-tag c2">Advance</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/02.jpg" alt="" /></a>
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
                                <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                              </h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 100%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-2.jpg" alt="" />
                                    <h6>Michel Johny</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>100% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Start Course</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item pending">
                            <span class="course-tag c1">Beginer</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/03.jpg" alt="" /></a>
                            </div>
                            <div class="course-content">
                              <div class="course-meta">
                                <span class="category c2">Business</span>
                                <div class="rating">
                                  <i class="fas fa-star"></i>
                                  <span>2.9k</span>
                                </div>
                              </div>
                              <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 45%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-3.jpg" alt="" />
                                    <h6>Glines Joey</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>45% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Finish Course</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item finished">
                            <span class="course-tag c2">Advance</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/04.jpg" alt="" /></a>
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
                                <a href="course-single.html">The Business Plan Course Includes 50 Templates</a>
                              </h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 100%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-4.html" alt="" />
                                    <h6>Nancy Alarcon</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>100% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Start Course</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item pending">
                            <span class="course-tag c2">Advance</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/02.jpg" alt="" /></a>
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
                                <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                              </h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 85%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-2.jpg" alt="" />
                                    <h6>Michel Johny</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>85% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Finish Course</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="course-item start">
                            <span class="course-tag c1">Beginer</span>
                            <div class="course-img">
                              <a href="course-single.html"><img src="/assets/front/img/course/03.jpg" alt="" /></a>
                            </div>
                            <div class="course-content">
                              <div class="course-meta">
                                <span class="category c2">Business</span>
                                <div class="rating">
                                  <i class="fas fa-star"></i>
                                  <span>2.9k</span>
                                </div>
                              </div>
                              <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                              <div class="course-info">
                                <ul>
                                  <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                  <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                </ul>
                              </div>
                              <div class="course-progress">
                                <div class="course-progress-width" style="width: 45%"></div>
                              </div>
                              <div class="course-bottom">
                                <a href="#">
                                  <div class="course-instructor">
                                    <img src="/assets/front/img/course/ins-3.jpg" alt="" />
                                    <h6>Glines Joey</h6>
                                  </div>
                                </a>
                                <div class="course-status">
                                  <span>0% Finish</span>
                                </div>
                              </div>
                              <a href="#" class="theme-btn"><span class="far fa-circle-play"></span> Start Course</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- pagination -->
                      <div class="pagination-area mb-3">
                        <div aria-label="Page navigation example">
                          <ul class="pagination mt-5">
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true"><i class="far fa-angle-double-left"></i></span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true"><i class="far fa-angle-double-right"></i></span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- pagination end -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- user wishlist end -->
    </main>
 @endsection