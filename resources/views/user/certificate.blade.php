   @extends('front.layout.app')
@section('title')
Forget Password
@endsection
@section('main')


    <main class="main">
       
      <!-- user certificate -->
      <div class="user-account py-70">
        <div class="container">
          <div class="row g-4">
             @include('user.layout.sidebar')
            <div class="col-lg-8 col-xl-9">
              <div class="user-wrapper user-certificate">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="user-card">
                      <h4 class="title">My Certificates</h4>
                      <div class="certificate-wrap">
                        <div class="certificate-item mb-4">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>HTML/CSS Basics - Certificate</h6>
                            <p>Completion Date: <span>15 Aug, 2025</span> Issued on: <span>19 Oct, 2025</span></p>
                          </div>
                          <a href="#" class="theme-btn"><span class="far fa-download"></span>Download</a>
                        </div>
                        <div class="certificate-item mb-4">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>HTML/CSS Basics - Certificate</h6>
                            <p>Completion Date: <span>15 Aug, 2025</span> Issued on: <span>19 Oct, 2025</span></p>
                          </div>
                          <a href="#" class="theme-btn"><span class="far fa-download"></span>Download</a>
                        </div>
                        <div class="certificate-item">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>HTML/CSS Basics - Certificate</h6>
                            <p>Completion Date: <span>15 Aug, 2025</span> Issued on: <span>19 Oct, 2025</span></p>
                          </div>
                          <a href="#" class="theme-btn"><span class="far fa-download"></span>Download</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="user-card user-skill">
                      <h4 class="title">Skills Achieved</h4>
                      <div class="skill-wrap">
                        <a href="#">HTML/CSS</a>
                        <a href="#">JavaScript</a>
                        <a href="#">UX/UI Design</a>
                        <a href="#">React Js</a>
                        <a href="#">Angular Js</a>
                        <a href="#">Vue Js</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="user-card">
                      <h4 class="title">Get New Certification</h4>
                      <div class="certificate-wrap">
                        <div class="certificate-item mb-4">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>Full Stack Web Development</h6>
                            <p>Associate Certification</p>
                          </div>
                          <a href="#" class="theme-btn">Start Now<i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="certificate-item mb-4">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>Full Stack Web Development</h6>
                            <p>Associate Certification</p>
                          </div>
                          <a href="#" class="theme-btn">Start Now<i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="certificate-item">
                          <div class="icon">
                            <img src="/assets/front/img/certificate/01.png" alt="" />
                          </div>
                          <div class="content">
                            <h6>Full Stack Web Development</h6>
                            <p>Associate Certification</p>
                          </div>
                          <a href="#" class="theme-btn">Start Now<i class="fas fa-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- user certificate end -->
    </main>
 @endsection