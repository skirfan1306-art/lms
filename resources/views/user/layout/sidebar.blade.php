<div class="col-lg-4 col-xl-3">
              <div class="user-sidebar">
                <div class="sidebar-top">
                  <div class="profile-img">
                      @if( Auth::user()->image )
                    <img src="/assets/front/images/users/{{ Auth::user()->image }}" alt="" />
                    @else
                    <img src="/assets/front/images/users/user-dummy-img.jpg" alt="" />
                    @endif
                    
                  </div>
                  <h5>{{ Auth::user()->name }}</h5>
                  <p><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></p>
                </div>
                <ul class="sidebar-list">
                  <li>
                    <a class="{{ Route::is('front.dashboard') ? 'active' : '' }}" href="{{ route('front.dashboard') }}"><i class="far fa-gauge-high icon"></i> Dashboard</a>
                  </li>
                   
                  <li>
                    <a class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{ route('user.profile') }}"><i class="far fa-user-tie-hair icon"></i> My Profile</a>
                  </li>
                  
                  <li>
                    <a class="{{ Route::is('user.my-course') ? 'active' : '' }}" href="{{ route('user.my-course') }}"><i class="far fa-book-open-reader icon"></i> My Courses</a>
                  </li>
                   
                  <li>
                    <a class="{{ Route::is('certificate') ? 'active' : '' }}" href="{{ route('user.certificate') }}"><i class="far fa-file-certificate icon"></i> Certificate</a>
                  </li>
                 
                  <li>
                    <a href="{{ route('user.logout') }}"><i class="far fa-sign-out icon"></i> Logout</a>
                  </li>
                </ul>
              </div>
            </div>