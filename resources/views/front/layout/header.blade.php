    <!-- header area -->
    <header class="header">
      <!-- navbar -->
      <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
          <div class="container position-relative">
            <a class="navbar-brand" href="{{ route('front.home') }}">
              <img src="{{ asset('assets/logo/' . $gs->logo ) }}" alt="logo" />
            </a>
            <div class="mobile-menu-right">
              <div class="mobile-menu-btn">
                <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
              </div>
              <a href="course-cart.html" class="nav-right-link course-cart">
                <i class="far fa-shopping-bag"></i><span class="count">0</span>
              </a>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar"
                aria-label="Toggle navigation"
              >
                <span></span>
                <span></span>
                <span></span>
              </button>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <a href="{{ route('front.home') }}" class="offcanvas-brand" id="offcanvasNavbarLabel">
                  <img src="assets/img/logo/logo.png" alt="" />
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                  <i class="far fa-xmark"></i>
                </button>
              </div>
              <div class="offcanvas-body gap-xl-4">
                <ul class="navbar-nav justify-content-end flex-grow-1">
                  <li class="nav-item">
                    <a class="nav-link {{ Route::is('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}">Home</a>
                     
                  </li>
                  
                  
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Category</a>

  <ul class="dropdown-menu fade-down">
    @foreach($headerCategories as $hcategory)

      @if($hcategory->subcategory->count() > 0)
        <li class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">
            {{ $hcategory->name }}
          </a>

          <ul class="dropdown-menu">
            @foreach($hcategory->subcategory as $sub)
              <li>
                <!-- link to course listing with subcategory query param -->
                <a class="dropdown-item" href="{{ route('front.course', ['subcategory' => $sub->slug]) }}">
                  {{ $sub->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @else
        <li>
          <!-- link to course listing with category query param -->
          <a class="dropdown-item" href="{{ route('front.course', ['category' => $hcategory->slug]) }}">
            {{ $hcategory->name }}
          </a>
        </li>
      @endif

    @endforeach
  </ul>
</li>


                  
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link {{ Route::is('front.course') ? 'active' : '' }}" href="{{ route('front.course') }}">Course</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link {{ Route::is('front.blog') ? 'active' : '' }}" href="{{ route('front.blog') }}">Blog</a>
                  </li>
                  
                  <li class="nav-item"><a class="nav-link {{ Route::is('front.contact') ? 'active' : '' }}" href="{{ route('front.contact') }}">Contact</a></li>
                </ul>
                <!-- nav-right -->
                <div class="nav-right">
                  <div class="search-btn">
                    <button type="button" class="nav-right-link search-box-outer"><i class="far fa-search"></i></button>
                  </div>
                  
                  @if(Auth::check())
                  <a href="{{ route('front.cart') }}" class="nav-right-link course-cart">
                    <i class="far fa-shopping-bag"></i>
                    <span class="count" id="cart-count">
                        @auth
                            {{ \App\Models\Cart::where('status', 'pending')->where('user_id', Auth::id())->count() }}
                        @else
                            0
                        @endauth
                    </span>
                  </a>
                  <div class="account-profile">
                    <a href="{{ route('front.dashboard') }}">
                        @if( Auth::user()->image )
                    <img src="/assets/front/images/users/{{ Auth::user()->image }}" alt="" />
                    @else
                    <img src="/assets/front/images/users/user-dummy-img.jpg" alt="" />
                    @endif
                    </a>
                  </div>
                  @else
                  <a href="{{ route('login') }}" class="nav-right-link course-cart">
                    <i class="far fa-shopping-bag"></i>
                  </a>
                   <div class="nav-btn">
                    <a href="{{ route('login') }}" class="theme-btn"><span class="far fa-sign-in"></span> Sign In</a>
                  </div>
                  @endif
                  <button type="button" class="sidebar-btn nav-right-link" data-bs-toggle="offcanvas" data-bs-target="#sidebarPopup">
                    <span></span>
                    <span></span>
                    <span></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
      <!-- navbar end-->
    </header>
    <!-- header area end -->

    <!-- popup search -->
    <div class="search-popup">
      <button class="close-search"><span class="far fa-times"></span></button>
      <form action="{{ route('front.course') }}">
        <div class="form-group">
          <input type="search" autocomplete="off" name="search" class="form-control" placeholder="Search Here..." required />
          <button type="submit"><i class="far fa-search"></i></button>
        </div>
      </form>
    </div>
    <!-- popup search end -->

    <!-- sidebar-popup -->
    <div class="sidebar-popup offcanvas offcanvas-end" tabindex="-1" id="sidebarPopup">
      <div class="offcanvas-header">
        <a href="{{ route('front.home') }}" class="sidebar-popup-logo">
          <img src="assets/img/logo/logo.png" alt="" />
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="far fa-xmark"></i>
        </button>
      </div>
      <div class="sidebar-popup-wrap offcanvas-body">
        <div class="sidebar-popup-content">
          <div class="sidebar-popup-about">
            <h4>About Us</h4>
            <p>
              There are many variations of passages available sure there majority have suffered alteration in some form by inject humour or
              randomised words which don't look even slightly believable.
            </p>
          </div>
          <div class="sidebar-popup-contact">
            <h4>Contact Info</h4>
            <ul>
              <li>
                <div class="icon">
                  <i class="far fa-envelope"></i>
                </div>
                <div class="content">
                  <h6>Email</h6>
                  <a href="{{ $gs->email }}">{{ $gs->email }}</span></a>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="far fa-phone"></i>
                </div>
                <div class="content">
                  <h6>Phone</h6>
                  <a href="tel:{{ $gs->number }}">{{ $gs->number }}</a>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="far fa-location-dot"></i>
                </div>
                <div class="content">
                  <h6>Address</h6>
                  <a>{{ $gs->address }}</a>
                </div>
              </li>
            </ul>
          </div>
          <div class="sidebar-popup-social">
            <h4>Follow Us</h4>
             @if(!empty($gs->facebook))
                  <a target="_blank" href="{{ $gs->facebook }}"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(!empty($gs->instagram))
                  <a target="_blank" href="{{ $gs->instagram }}"><i class="fab fa-instagram"></i></a>
                @endif
                @if(!empty($gs->twitter))
                  <a target="_blank" href="{{ $gs->twitter }}"><i class="fab fa-x-twitter"></i></a>
                @endif
                @if(!empty($gs->linkedin))
                  <a target="_blank" href="{{ $gs->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                @endif
          </div>
        </div>
      </div>
    </div>
    <!-- sidebar-popup end -->